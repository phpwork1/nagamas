<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SpendingDetail */

$this->title = 'Update Spending Detail: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Spending Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spending-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
