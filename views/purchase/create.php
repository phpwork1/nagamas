<?php

use yii\helpers\Html;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BUY_REPORT, 'url' => ['buy-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::PURCHASE, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
