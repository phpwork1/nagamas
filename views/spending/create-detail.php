<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SpendingDetail */

$this->title = 'Create Spending Detail';
$this->params['breadcrumbs'][] = ['label' => 'Spending Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spending-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
