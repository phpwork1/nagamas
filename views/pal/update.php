<?php

use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Pal */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::SELL);
$this->params['breadcrumbs'][] = ['label' => AppLabels::PAL_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->p_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="pal-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
