<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\Seller */

$this->title = sprintf("%s %s", AppLabels::VIEW, AppLabels::SELLER);
$this->params['breadcrumbs'][] = ['label' => AppLabels::SELLER_LIST, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ],
]);
?>
<div class="seller-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            's_name',
            's_address',
            's_m_number',
        ],
    ]) ?>

    <div class="col-md-12">
        <div class="text-center">
            <h3><?= sprintf("%s %s", AppLabels::HISTORY, AppLabels::SELL) ?></h3>
        </div>

        <?php foreach ($model->purchases as $key => $purchase) :
            $weightTotal = 0;
            $dirtyTotal = 0;
            $commissionTotal = 0;
            $laborTotal = 0;
            $stampTotal = 0;
            $cleanTotal = 0;
            $count = 0;
            ?>
            <div class="row">
                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%"><?= AppLabels::DATE ?></th>
                        <th class="text-center" width="5%"><?= AppLabels::GROUP ?></th>
                        <th class="text-center"
                            width="10%"><?= sprintf("%s %s", AppLabels::PRICE, AppLabels::RUBBER) ?></th>
                        <th class="text-center"
                            width="10%"><?= sprintf("%s %s", AppLabels::WEIGHT, AppLabels::RUBBER) ?></th>
                        <th class="text-center"
                            width="10%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::DIRTY) ?></th>
                        <th class="text-center"
                            width="10%"><?= AppLabels::COMMISSION ?></th>
                        <th class="text-center" width="10%"><?= AppLabels::LABOR ?></th>
                        <th class="text-center" width="5%"><?= AppLabels::STAMP ?></th>
                        <th class="text-center" width="10%"><?= AppLabels::OTHER ?></th>
                        <th class="text-center"
                            width="20%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($purchase->purchaseDetails as $keyDetail => $detail) :
                        $weightTotal += $detail->pd_rubber_weight;
                        $dirtyTotal += $detail->total_dirty;
                        $commissionTotal += $detail->commission;
                        $laborTotal += $detail->labor;
                        $stampTotal += $detail->stamp;
                        $cleanTotal = $dirtyTotal - $commissionTotal - $laborTotal - $stampTotal;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $count == 0 ? $detail->purchase->p_date : "" ?></td>
                            <td class="text-center"><?= $detail->pd_name ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->pd_rubber_price) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asInteger($detail->pd_rubber_weight) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->total_dirty) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->commission) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->labor) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->stamp) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->pd_other) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->total_clean) ?></td>
                        </tr>
                        <?php $count++; endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-center"><?= AppLabels::TOTAL ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($weightTotal) ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($dirtyTotal) ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($commissionTotal) ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($laborTotal) ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($stampTotal) ?></td>
                        <td></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($cleanTotal) ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>

</div>
