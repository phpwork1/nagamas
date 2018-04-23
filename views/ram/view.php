<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Bam */

$this->title = sprintf("%s %s %s", AppLabels::VIEW, AppLabels::DETAIL, AppLabels::RAM_LIST);
$this->params['breadcrumbs'][] = ['label' => sprintf("%s %s", AppLabels::REPORT, AppLabels::RAM_LIST), 'url' => ['buy-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::RAM_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                'value' => Yii::$app->formatter->asInteger($model->r_bruto),
            ],
            [
                'attribute' => 'p_tarra',
                'value' => Yii::$app->formatter->asInteger($model->r_tarra),
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
