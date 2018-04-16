<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\base\AppLabels;
use app\models\Seller;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AppLabels::PURCHASE;
$this->params['breadcrumbs'][] = ['label' => AppLabels::BUY_REPORT, 'url' => ['buy-report']];
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
                'attribute' => 'seller_id',
                'value' => 'seller.s_name',

                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'seller_id',
                    'data' => Seller::map(),
                    'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'p_date',
                'value' => 'p_date',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'language' => 'id',
                    'dateFormat' => 'yyyy-MM-dd',
                    'attribute' => 'p_date',
                    'options' => ['id' => 'date1', 'class' => 'form-control'],
                ]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
