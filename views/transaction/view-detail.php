<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionDetail */

$this->title = sprintf("%s %s %s", AppLabels::VIEW, AppLabels::GROUP, $model->td_name);
$this->params['breadcrumbs'][] = ['label' => AppLabels::FACTORY_REPORT, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => sprintf("%s Tgl: %s",AppLabels::TRANSACTION, $model->transaction->t_date), 'url' => ['view', 'id' => $model->transaction_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-detail-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'td_name',
            'td_rubber_weight:integer',
            'td_rubber_price:currency',
            'total:currency',
        ],
    ]) ?>

</div>
