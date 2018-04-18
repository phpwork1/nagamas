<?php

use app\components\base\AppLabels;



/* @var $this yii\web\View */
/* @var $model app\models\Bam */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::SELL);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BAM_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bam-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
