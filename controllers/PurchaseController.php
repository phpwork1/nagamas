<?php

namespace app\controllers;

use Yii;
use app\models\Purchase;
use app\models\PurchaseSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\base\AppConstants;
use app\models\PurchaseDetailSearch;
use app\models\PurchaseDetail;
use app\models\Seller;

/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Purchase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new PurchaseDetailSearch();
        $searchModel->purchase_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransactionDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewDetail($id)
    {
        return $this->render('view-detail', [
            'model' => PurchaseDetail::findOne($id),
        ]);
    }

    /**
     * Updates an existing TransactionDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateDetail($id)
    {
        $model = PurchaseDetail::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-detail', 'id' => $model->id]);
        }

        return $this->render('update-detail', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TransactionDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteDetail($id)
    {
        $model = PurchaseDetail::findOne($id);
        $id = $model->purchase_id;
        $model->delete();

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionCreateDetail($id)
    {
        $model = new PurchaseDetail();
        $model->purchase_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
            return $this->redirect(['view', 'id' => $model->purchase_id]);
        }

        return $this->render('create-detail', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Purchase();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionBuyReport()
    {

        $month = Yii::$app->formatter->asDate(time(), 'M');
        $year = Yii::$app->formatter->asDate(time(), 'Y');

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();
            if (isset($requestData['month'])) {
                $month = $requestData['month'];
            }

            if (isset($requestData['year'])) {
                $year = $requestData['year'];
            }
        }
        $model = Purchase::findBySql("SELECT * FROM purchase where EXTRACT(MONTH FROM p_date) = $month AND EXTRACT(YEAR FROM p_date) = $year ORDER BY p_date DESC;")->all();


        return $this->render('buy-report', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Updates an existing Purchase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_UPDATE);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Purchase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_DELETE);

        return $this->redirect(['index']);
    }

    public function actionAjaxSellerByDate()
    {
        $requestData = Yii::$app->request->post();
        $sellerId = $requestData['sellerId'];
        $date = $requestData['date'];
        $seller = Seller::find()->where(['id' => $sellerId])->one();
        $sellerPurchaseData = $seller->getPurchasesLimitBy(5, $date)->all();

        $data = [];
        foreach ($sellerPurchaseData as $key => $value) {
            $detail = [];
            $purchaseDetails = PurchaseDetail::find()->where(['purchase_id' => $value->id])->all();
            foreach ($purchaseDetails as $keyDetails => $purchaseDetail) {
                $detail[] = array(
                    "name" => $purchaseDetail->pd_name,
                    "weight" => $purchaseDetail->pd_rubber_weight,
                    "price" => $purchaseDetail->pd_rubber_price,
                    "total" => $purchaseDetail->total,
                );
            }
            $data[] = array(
                "date" => $value->p_date,
                "detail" => $detail,
                "totalWeight" => $value->total_weight,
                "totalDirty" => $value->total_dirty,
                "commission" => $value->commission,
                "labor" => $value->labor,
                "stamp" => $value->stamp,
                "other" => $value->p_other,
                "totalClean" => $value->total_clean,
            );
        }
        if (!empty($data)) {
            return Json::encode($data);
        }
        return Json::encode(false);
    }

    public function actionAjaxPurchaseDetail()
    {
        $requestData = Yii::$app->request->post();
        $purchaseId = $requestData['purchaseId'];
        $purchase = Purchase::find()->where(['id' => $purchaseId])->one();

        foreach ($purchase->purchaseDetails as $keyDetails => $purchaseDetail) {
            $detail[] = array(
                "name" => $purchaseDetail->pd_name,
                "weight" => $purchaseDetail->pd_rubber_weight,
                "price" => $purchaseDetail->pd_rubber_price,
                "total" => $purchaseDetail->total,
            );
        }
        $data = array(
            "detail" => $detail,
        );
        if (!empty($data)) {
            return Json::encode($data);
        }
        return Json::encode(false);
    }

    /**
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
