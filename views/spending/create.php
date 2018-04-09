<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Spending */

$this->title = 'Create Spending';
$this->params['breadcrumbs'][] = ['label' => 'Spendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spending-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
