<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 30.05.16
 * Time: 1:32
 */
    use yii\helpers\Html;
    use kartik\export\ExportMenu;
    use kartik\grid\GridView;

     GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'DateTime',
            'hometeam',
            'awayteam',
            'StadiumID',
            [
                'label' => 'Name',
                'value' => 'messageTrigger.object_name',
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete} '],
        ],
    ]);