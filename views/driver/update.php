<?php

use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::DRIVER);
$this->params['breadcrumbs'][] = ['label' => AppLabels::DRIVER_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->d_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="driver-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
