<?php

use yii\helpers\Html;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Purchase */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BUY_REPORT, 'url' => ['buy-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::PURCHASE, 'url' => ['index']];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="purchase-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
