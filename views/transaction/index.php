<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\base\AppLabels;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AppLabels::FACTORY_REPORT;
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-print"></i>', ['report'], [
        'type' => 'button',
        'title' => sprintf("%s %s", AppLabels::DETAIL, AppLabels::TRANSACTION),
        'class' => 'btn btn-info'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'class' => 'btn btn-success',
        'title' => Yii::t('app', 'Tambah Transaksi')
    ])
];
?>
<div class="transaction-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'buyer_id',
                'value' => 'buyer.b_name',
                'label' => sprintf("%s %s", AppLabels::NAME, AppLabels::BUYER),
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'buyer_id',
                    'data' => \app\models\Buyer::map(),
                    'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 't_date',
                'value' => 't_date',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'language' => 'id',
                    'dateFormat' => 'yyyy-MM-dd',
                    'attribute' => 't_date',
                    'options' => ['id' => 'date1', 'class' => 'form-control'],
                ]),
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
