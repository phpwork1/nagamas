<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Spending */

$this->title = 'Update Spending: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Spendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spending-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
