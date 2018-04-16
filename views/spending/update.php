<?php

use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Spending */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::SPENDING);
$this->params['breadcrumbs'][] = ['label' => AppLabels::SPENDING_REPORT, 'url' => ['spend-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::SPENDING, 'url' => ['index']];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="spending-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
