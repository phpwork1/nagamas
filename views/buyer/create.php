<?php

use yii\helpers\Html;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Buyer */

$this->title = sprintf('%s %s', AppLabels::ADD, AppLabels::BUYER);
$this->params['breadcrumbs'][] = ['label' => AppLabels::BUYER_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buyer-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
