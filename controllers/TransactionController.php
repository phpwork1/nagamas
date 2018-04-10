<?php

namespace app\controllers;

use app\models\TransactionDetail;
use Yii;
use app\models\Transaction;
use app\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\base\AppConstants;
use app\models\TransactionDetailSearch;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new TransactionDetailSearch();
        $searchModel->transaction_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        $model = TransactionDetail::findOne($id);

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
        $model = TransactionDetail::findOne($id);
        $id = $model->transaction_id;
        $model->delete();

        return $this->redirect(['view', 'id' => $id]);
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
            'model' => TransactionDetail::findOne($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionReport()
    {

        $month = Yii::$app->formatter->asDate(time(), 'M');
        $year = Yii::$app->formatter->asDate(time(), 'Y');

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();
            if (isset($requestData['month'])) {
                $month = $requestData['month'];
            }

            if(isset($requestData['year'])){
                $year = $requestData['year'];
            }
        }
        $model = Transaction::findBySql("SELECT * FROM transaction where EXTRACT(MONTH FROM t_date) = $month AND EXTRACT(YEAR FROM t_date) = $year")->all();


        return $this->render('report', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function actionSellReport()
    {
        $buyer = AppConstants::DEFAULT_BUYER;
        $month = Yii::$app->formatter->asDate(time(), 'M');
        $year = Yii::$app->formatter->asDate(time(), 'Y');

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();
            if (isset($requestData['buyer'])) {
                $buyer = $requestData['buyer'];
            }

            if (isset($requestData['month'])) {
                $month = $requestData['month'];
            }

            if(isset($requestData['year'])){
                $year = $requestData['year'];
            }
        }
        $model = Transaction::findBySql("SELECT * FROM transaction where EXTRACT(MONTH FROM t_date) = $month AND EXTRACT(YEAR FROM t_date) = $year AND buyer_id = $buyer ORDER BY t_date DESC;")->all();
        return $this->render('sell-report', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
            'buyer' => $buyer,
        ]);
    }

    public function actionCreate()
    {
        $model = new Transaction();
        $model->buyer_id = 2;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateDetail($id)
    {
        $model = new TransactionDetail();
        $model->transaction_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
            return $this->redirect(['view', 'id' => $model->transaction_id]);
        }

        return $this->render('create-detail', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transaction model.
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
     * Deletes an existing Transaction model.
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
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
