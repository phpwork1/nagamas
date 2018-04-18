<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AppLabels::CAR_LIST;
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type' => 'button',
        'title' => sprintf("%s %s", AppLabels::ADD, AppLabels::CAR),
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Refresh')
    ])
];
?>
<div class="car-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'c_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
