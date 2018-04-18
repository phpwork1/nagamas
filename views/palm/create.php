<?php

use app\components\base\AppLabels;



/* @var $this yii\web\View */
/* @var $model app\models\Palm */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::PRICE);
$this->params['breadcrumbs'][] = ['label' => AppLabels::PALM_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="palm-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
