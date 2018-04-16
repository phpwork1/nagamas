<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpendingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AppLabels::SPENDING;
$this->params['breadcrumbs'][] = ['label' => AppLabels::SPENDING_REPORT, 'url' => ['spend-report']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'class' => 'btn btn-success',
        'title' => Yii::t('app', 'Tambah Transaksi')
    ])
];
?>
<div class="purchase-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 's_date',
                'value' => 's_date',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'language' => 'id',
                    'dateFormat' => 'yyyy-MM-dd',
                    'attribute' => 's_date',
                    'options' => ['id' => 'date1', 'class' => 'form-control'],
                ]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
