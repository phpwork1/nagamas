<?php

namespace app\controllers;

use app\models\SpendingDetailSearch;
use Yii;
use app\models\Spending;
use app\models\SpendingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\base\AppConstants;
use app\models\SpendingDetail;
use app\models\Purchase;

/**
 * SpendingController implements the CRUD actions for Spending model.
 */
class SpendingController extends Controller
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
     * Lists all Spending models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpendingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSpendReport()
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
        $model = Spending::findBySql("SELECT * FROM spending where EXTRACT(MONTH FROM s_date) = $month AND EXTRACT(YEAR FROM s_date) = $year ORDER BY s_date ASC")->all();
        $spendByPurchase = Purchase::findBySql("SELECT * FROM purchase where EXTRACT(MONTH FROM p_date) = $month AND EXTRACT(YEAR FROM p_date) = $year AND p_fresh = 1 AND p_transfer = 0 ORDER BY p_date ASC")->all();

        return $this->render('spend-report', [
            'model' => $model,
            'purchase' => $spendByPurchase,
            'month' => $month,
            'year' => $year,
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
            'model' => SpendingDetail::findOne($id),
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
        $model = SpendingDetail::findOne($id);

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
        $model = SpendingDetail::findOne($id);
        $id = $model->spending_id;
        $model->delete();

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionCreateDetail($id)
    {
        $model = new SpendingDetail();
        $model->spending_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
            return $this->redirect(['view', 'id' => $model->spending_id]);
        }

        return $this->render('create-detail', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Spending model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new SpendingDetailSearch();
        $searchModel->spending_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Spending model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Spending();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Spending model.
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
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Spending model.
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

    /**
     * Finds the Spending model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Spending the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Spending::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
