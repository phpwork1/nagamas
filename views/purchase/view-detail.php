<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseDetail */

$this->title = sprintf("%s %s Tgl: %s dengan %s untuk partai %s",AppLabels::DETAIL, AppLabels::PURCHASE, $model->purchase->p_date, $model->purchase->seller->s_name, $model->pd_name);
$this->params['breadcrumbs'][] = ['label' => sprintf("%s %s", AppLabels::DETAIL, AppLabels::PURCHASE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => sprintf("%s Tgl: %s",AppLabels::PURCHASE, $model->purchase->p_date), 'url' => ['view', 'id' => $model->purchase_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-detail-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pd_name',
            'seller_name',
            'pd_rubber_weight:integer',
            'pd_rubber_price:currency',
            'total_dirty:currency',
            'commission:currency',
            'labor:currency',
            'stamp:currency',
            'pd_other:currency',
            'total_clean:currency',
        ],
    ]) ?>

</div>
