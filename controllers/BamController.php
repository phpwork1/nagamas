<?php

namespace app\controllers;

use app\models\Palm;
use Yii;
use app\models\Bam;
use app\models\BamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\base\AppConstants;

/**
 * BamController implements the CRUD actions for Bam model.
 */
class BamController extends Controller
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
     * Lists all Bam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bam model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bam();
        //$model->b_price = Palm::getLatestPrice(AppConstants::BAM);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionReport()
    {

        $month = Yii::$app->formatter->asDate(time(), 'M');
        $year = Yii::$app->formatter->asDate(time(), 'Y');
        $monthBefore = $month-1;
        $factory = AppConstants::BAM;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();
            if (isset($requestData['month'])) {
                $month = $requestData['month'];
            }

            if (isset($requestData['year'])) {
                $year = $requestData['year'];
            }
        }
        $model = Bam::findBySql("SELECT * FROM bam where EXTRACT(MONTH FROM b_date) = $month AND EXTRACT(YEAR FROM b_date) = $year ORDER BY b_date ASC;")->all();
        $price = Palm::findBySql("SELECT * FROM palm where EXTRACT(MONTH FROM p_date) = $month AND EXTRACT(YEAR FROM p_date) = $year AND factory = '$factory' UNION
                                      SELECT * FROM palm where EXTRACT(MONTH FROM p_date) = $monthBefore AND EXTRACT(YEAR FROM p_date) = $year AND factory = '$factory' ORDER BY p_date ASC;")->all();

        return $this->render('report', [
            'model' => $model,
            'month' => $month,
            'year' => $year,
            'price' => $price,
        ]);
    }

    /**
     * Updates an existing Bam model.
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
     * Deletes an existing Bam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bam::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
