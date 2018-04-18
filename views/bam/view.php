<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Bam */

$this->title = sprintf("%s %s %s", AppLabels::VIEW, AppLabels::DETAIL, AppLabels::BAM_LIST);
$this->params['breadcrumbs'][] = ['label' => sprintf("%s %s", AppLabels::REPORT, AppLabels::BAM_LIST), 'url' => ['buy-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::BAM_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create-detail', 'id' => $model->id], [
        'class' => 'btn btn-success',
        'title' => Yii::t('app', 'Tambah Transaksi')
    ])
];
?>
<div class="pal-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'driver_id',
                'value' => $model->driver->d_name,
            ],
            [
                'attribute' => 'car_id',
                'value' => $model->car->c_name,
            ],
            [
                'attribute' => 'area_id',
                'value' => $model->area->a_name,
            ],
            [
                'attribute' => 'p_bruto',
                'value' => Yii::$app->formatter->asInteger($model->b_bruto),
            ],
            [
                'attribute' => 'p_tarra',
                'value' => Yii::$app->formatter->asInteger($model->b_tarra),
            ],
            [
                'attribute' => 'netto',
                'value' => Yii::$app->formatter->asInteger($model->netto),
            ],
            [
                'attribute' => 'total',
                'value' => Yii::$app->formatter->asCurrency($model->total),
            ],
        ],
    ]) ?>

</div>
