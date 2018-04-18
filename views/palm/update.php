<?php

use yii\helpers\Html;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Palm */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::PRICE);
$this->params['breadcrumbs'][] = ['label' => AppLabels::PALM_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->p_date, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="palm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
