<?php

use yii\helpers\Html;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseDetail */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BUY_REPORT, 'url' => ['buy-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::PURCHASE    , 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => sprintf("%s Tgl: %s",AppLabels::PURCHASE, $model->purchase->p_date), 'url' => ['view', 'id' => $model->purchase_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">

    <?= $this->render('_form-detail', [
        'model' => $model,
    ]) ?>

</div>
