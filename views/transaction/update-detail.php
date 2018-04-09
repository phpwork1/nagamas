<?php

use yii\helpers\Html;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\TransactionDetail */

$this->title = sprintf("%s %s %s", AppLabels::UPDATE, AppLabels::DETAIL, AppLabels::TRANSACTION);
$this->params['breadcrumbs'][] = ['label' => AppLabels::FACTORY_REPORT, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => sprintf("%s Tgl: %s",AppLabels::TRANSACTION, $model->transaction->t_date), 'url' => ['view', 'id' => $model->transaction_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-detail-update">

    <?= $this->render('_form-detail', [
        'model' => $model,
    ]) ?>

</div>
