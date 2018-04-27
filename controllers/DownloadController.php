<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\Controller;
use app\components\base\AppConstants;
/**
 * DownloadController implements the CRUD actions for Download model.
 */
class DownloadController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete-all' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Download models.
     * @return mixed
     */
    public function actionExcel($filename = null) {
        if ($filename !== null) {
            $file = Yii::getAlias(AppConstants::THEME_EXCEL_EXPORT_DIR) . $filename;
            if (file_exists($file)) {
                Yii::$app->response->on(Response::EVENT_AFTER_SEND, function ($event){
                    unlink($event->data);
                }, $file);
                Yii::$app->response->sendFile($file);
            } else {
                Yii::$app->session->setFlash('danger', AppConstants::ERR_DOWNLOAD_FAILED);
            }
            
//            return $this->render('index', [
//                'filename' => $filename
//            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
