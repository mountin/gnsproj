<?php

namespace app\controllers;

use app\models\MLBSeason;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class ApiController extends Controller
{
    public function actionGames()
    {
        return $this->render('games');
    }

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionGetschedulebase(){

        $model  = MLBSeason::find()->asArray()->all();

        echo json_encode($model);

    }

    public function actionIndex2($page = 0, $from = 0)
    {

        $provider = new ActiveDataProvider([
            'query' => MLBSeason::find(),
            'pagination' => [
                'pageSize' => 120,
            ],
        ]);

        $posts = $provider->getModels();


        return $this->render('index');
    }

}
