<?php

use yii\helpers\Html;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::TRANSACTION);
$this->params['breadcrumbs'][] = ['label' => AppLabels::FACTORY_REPORT, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
