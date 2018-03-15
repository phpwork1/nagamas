<?php

use yii\helpers\Html;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\TransactionDetail */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::TRANSACTION);
$this->params['breadcrumbs'][] = ['label' => AppLabels::FACTORY_REPORT, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->td_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="transaction-detail-update">

    <?= $this->render('_form-detail', [
        'model' => $model,
    ]) ?>

</div>
