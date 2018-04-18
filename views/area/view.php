<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Area */

$this->title = sprintf("%s %s", AppLabels::VIEW, AppLabels::AREA);
$this->params['breadcrumbs'][] = ['label' => AppLabels::AREA_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ],
]);
?>
<div class="area-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'a_name',
        ],
    ]) ?>

</div>
