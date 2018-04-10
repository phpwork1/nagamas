<?php

use yii\helpers\Html;
use app\components\base\AppLabels;
use yii\grid\GridView;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $searchModel app\models\PurchaseDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = sprintf("%s %s %s", AppLabels::VIEW, AppLabels::DETAIL, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BUY_REPORT, 'url' => ['buy-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::PURCHASE, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create-detail', 'id' => $model->id], [
        'class' => 'btn btn-success',
        'title' => Yii::t('app', 'Tambah Transaksi')
    ])
];
$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'view' => function ($url, $model) {
        return yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['view-detail', 'id' => $model->id], ['class' => 'btn-sm btn-info', 'title' => Yii::t('yii', 'Lihat Rincian Untuk item ini.'),]);
    },
    'update' => function ($url, $model) {
        return yii\helpers\Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update-detail', 'id' => $model->id], ['class' => 'btn-sm btn-warning', 'title' => Yii::t('yii', 'Ubah data item ini.'),]);
    },
    'delete' => function ($url, $model) {
        return yii\helpers\Html::a('<i class="glyphicon glyphicon-remove"></i>', ['delete-detail', 'id' => $model->id], ['class' => 'btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini'), 'data' => ['method' => 'post', 'confirm' => 'Yakin ingin menghapus data ini?']]);
    },
]);

//$model->updateTotal();
?>
<div class="purchase-view">
    <div class="row">
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'p_date',
                    [
                            'attribute' => 'seller_id',
                            'value' => $model->seller->s_name,
                    ],
                    'total_dirty:currency',
                    'total_clean:currency',
                ],
            ]) ?>
        </div>
    </div>

    <h2 class="header"><?= sprintf("%s %s", AppLabels::DETAIL, AppLabels::PURCHASE )?></h2>

    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'pd_name',
                'pd_rubber_weight:integer',
                'pd_rubber_price:currency',


                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => $buttons,
                ],
            ],
        ]); ?>
    </div>
</div>

