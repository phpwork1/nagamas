<?php

use yii\widgets\DetailView;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\SpendingDetail */

$this->title = sprintf("%s %s Tgl: %s untuk %s",AppLabels::DETAIL, AppLabels::SPENDING, $model->spending->s_date, $model->sd_name);
$this->params['breadcrumbs'][] = ['label' => sprintf("%s %s", AppLabels::DETAIL, AppLabels::SPENDING), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => sprintf("%s Tgl: %s",AppLabels::SPENDING, $model->spending->s_date), 'url' => ['view', 'id' => $model->spending_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-detail-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sd_name',
            'sd_spend_value:currency',
            'sd_labor:currency',
            'sd_other:currency',
            'sd_ref',
            'total:currency',
        ],
    ]) ?>

</div>
