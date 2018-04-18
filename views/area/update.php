<?php

use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Area */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::AREA);
$this->params['breadcrumbs'][] = ['label' => AppLabels::AREA_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->a_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="area-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
