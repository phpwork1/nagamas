<?php

use app\components\base\AppLabels;



/* @var $this yii\web\View */
/* @var $model app\models\Area */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::AREA);
$this->params['breadcrumbs'][] = ['label' => AppLabels::AREA_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
