<?php

use yii\helpers\Html;
use app\components\base\AppLabels;


/* @var $this yii\web\View */
/* @var $model app\models\Seller */

$this->title = sprintf("%s %s", AppLabels::ADD, AppLabels::SELLER);
$this->params['breadcrumbs'][] = ['label' => AppLabels::SELLER_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seller-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
