<?php

use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Car */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::CAR);
$this->params['breadcrumbs'][] = ['label' => AppLabels::CAR_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->c_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="car-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
