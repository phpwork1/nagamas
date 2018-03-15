<?php

use yii\helpers\Html;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Buyer */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::BUYER);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BUYER_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->b_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="buyer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
