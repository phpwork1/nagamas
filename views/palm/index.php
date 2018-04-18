<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\base\AppLabels;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PalmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AppLabels::PALM_LIST;
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type' => 'button',
        'title' => sprintf("%s %s", AppLabels::ADD, AppLabels::PRICE),
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Refresh')
    ])
];
?>
<div class="palm-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'factory',
                'value' => function($model){
                    return \app\components\base\AppConstants::$factory[$model->factory];
                },

                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'factory',
                    'data' => \app\components\base\AppConstants::$factory,
                    'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'p_date',
            'p_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
