<?php

use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Pal */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::SELL);
$this->params['breadcrumbs'][] = ['label' => AppLabels::PAL_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pal-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
