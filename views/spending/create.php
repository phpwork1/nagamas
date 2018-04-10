<?php

use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Spending */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::SPENDING);
$this->params['breadcrumbs'][] = ['label' => AppLabels::SPENDING_REPORT, 'url' => ['spend-report']];
$this->params['breadcrumbs'][] = ['label' => AppLabels::SPENDING, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spending-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
