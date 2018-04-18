<?php

use app\components\base\AppLabels;



/* @var $this yii\web\View */
/* @var $model app\models\Car */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::CAR);
$this->params['breadcrumbs'][] = ['label' => AppLabels::CAR_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
