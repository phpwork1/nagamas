<?php

use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Bam */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::SELL);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BAM_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->b_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="bam-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
