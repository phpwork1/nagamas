<?php

use yii\helpers\Html;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Seller */

$this->title = sprintf("%s %s", AppLabels::UPDATE, AppLabels::SELLER);
$this->params['breadcrumbs'][] = ['label' => AppLabels::SELLER_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->s_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AppLabels::UPDATE;
?>
<div class="seller-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
