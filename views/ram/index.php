<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\base\AppLabels;
use kartik\select2\Select2;
use app\models\Driver;
use app\models\Car;
use app\models\Area;



/* @var $this yii\web\View */
/* @var $searchModel app\models\RamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AppLabels::RAM_LIST;
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type' => 'button',
        'title' => sprintf("%s %s", AppLabels::ADD, AppLabels::SELL),
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Refresh')
    ])
];
?>
<div class="ram-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'driver_id',
                'value' => 'driver.d_name',

                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'driver_id',
                    'data' => Driver::map(),
                    'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'car_id',
                'value' => 'car.c_name',

                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'car_id',
                    'data' => Car::map(),
                    'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'area_id',
                'value' => 'area.a_name',

                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'area_id',
                    'data' => Area::map(),
                    'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'r_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
