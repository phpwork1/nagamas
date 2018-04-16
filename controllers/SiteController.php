<?php

namespace app\controllers;

use app\models\Purchase;
use app\models\TransactionDetail;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\components\base\AppConstants;
use app\models\PurchaseDetail;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'profit-loss'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new TransactionDetail();
        $modelPurchase = new PurchaseDetail();

        if(Yii::$app->request->isPost){
            $requestData = Yii::$app->request->post();
            if($requestData['action'] == AppConstants::ACTION_PURCHASE){
                if ($modelPurchase->load(Yii::$app->request->post()) && $modelPurchase->saveTransactional()) {
                    Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
                    $modelPurchase = new PurchaseDetail();
                }
            }else if($requestData['action'] == AppConstants::ACTION_TRANSACTION){
                if ($model->load(Yii::$app->request->post()) && $model->saveTransactional()) {
                    Yii::$app->session->setFlash('success', AppConstants::MESSAGE_SAVE_SUCCESS);
                    $model = new TransactionDetail();
                }
            }
        }

        $month = Yii::$app->formatter->asDate(time(), 'M');
        $year = Yii::$app->formatter->asDate(time(), 'Y');
        $lastPurchases = Purchase::getLastPurchases();
        $totalToday = Purchase::getTotalToday();
        $totalMonth = Purchase::getTotalWeightByMonthYear($month, $year);


        return $this->render('index', [
            'model' => $model,
            'totalToday' => $totalToday,
            'totalMonth' => $totalMonth,
            'lastPurchases' => $lastPurchases,
            'modelPurchase' => $modelPurchase,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                Yii::$app->session->setFlash('success', sprintf("%s %s",'Welcome back. ', Yii::$app->user->identity->getUsername()));
                return $this->goBack();
            } else {
                $this->layout = 'login';
                Yii::$app->session->setFlash('danger', 'Username / password salah.');
                return $this->render('login', ['model' => $model]);
            }
        } else {
            $this->layout = 'login';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionProfitLoss(){
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

            if (isset($requestData['year'])) {
                $year = $requestData['year'];
            }
        }

        return $this->render('profit-loss', [
            'month' => $month,
            'year' => $year,
            'buyer' => $buyer,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
