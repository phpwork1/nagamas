<?php

use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\SpendingDetail */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::SPENDING);
$this->params['breadcrumbs'][] = ['label' => AppLabels::SPENDING_REPORT, 'url' => ['spend-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::SPENDING, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => sprintf("%s Tgl: %s",AppLabels::SPENDING, $model->spending->s_date), 'url' => ['view', 'id' => $model->spending_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spending-detail-update">

    <?= $this->render('_form-detail', [
        'model' => $model,
    ]) ?>

</div>
