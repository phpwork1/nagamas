<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Palm */

$this->title = sprintf("Tanggal: %s", $model->p_date);
$this->params['breadcrumbs'][] = ['label' => AppLabels::PALM_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="palm-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'factory',
                'value' => function($model){
                    return \app\components\base\AppConstants::$factory[$model->factory];
                }
            ],
            'p_price',
        ],
    ]) ?>

</div>
