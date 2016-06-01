<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MLBSeason;
use linslin\yii2\curl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid;



class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    public function actionShowschedule(){

        $responce = json_decode(file_get_contents(Yii::$app->params["showSchedule"]));

        return $this->render('showMe', ['responce'=>$responce]);

    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionGet2(){


//        $model = new MLBSeason();
//        $model->isNewRecord = true;
//
//        $model->attributes = [
//            'GameID' => 11,
//            'season' => 22,
//            'status' => 33,
//            'DateTime' => 44
//        ];
//        var_dump($model->save(false));
//        die;
        $request = Yii::$app->params["request"];

        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"Accept-language: en\r\n" .
                    "Cookie: foo=bar\r\n".
                    "Ocp-Apim-Subscription-Key:".Yii::$app->params["Apim-Key"]
            )
        );

        $context = stream_context_create($opts);

        $json = file_get_contents($request, false, $context);

        $objParse = json_decode($json);

        if(!empty($objParse)){
            MLBSeason::deleteAll();
        }
        $i = 0 ;
        foreach($objParse as $facility)
        {

            $model = new MLBSeason();
            $model->isNewRecord = true;

            $model->attributes = [
                'GameID' => (int)$facility->GameID,
                'season' => (int)$facility->Season,
                'status' => $facility->Status,
                'DateTime' => $facility->DateTime,
                'day' => $facility->Day,
                'awayteam' => $facility->AwayTeam,
                'hometeam' => $facility->HomeTeam,
                'StadiumID' => (int)$facility->StadiumID,
            ];


            if ($model->validate()){
                if($model->save(true))
                    $i++;
            }
        }
        $result =  $i;

        return $this->render('parseData', ['result'=>$result]);


    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
