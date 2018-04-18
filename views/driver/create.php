<?php

use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::DRIVER);
$this->params['breadcrumbs'][] = ['label' => AppLabels::DRIVER_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
