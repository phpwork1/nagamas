<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use kartik\select2\Select2;
use app\assets\ReportAsset;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

ReportAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\models\Seller */
/* @var $purchases app\models\Purchase[] */
/* @var $month int */
/* @var $year int */

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
    <?php $form = ActiveForm::begin(); ?>
    <?php if (!empty($model->purchases)) : ?>
        <div class="col-md-2 col-md-offset-8">
            <?= Select2::widget([
                'name' => 'month',
                'value' => $month,
                'data' => AppConstants::$month,
                'options' => ['id' => 'month-select', 'class' => 'input-lg form-control']
            ]); ?>
        </div>

        <div class="col-md-2">
            <?= Select2::widget([
                'name' => 'year',
                'value' => $year,
                'data' => AppConstants::$year,
                'options' => ['id' => 'year-select', 'class' => 'input-lg form-control']
            ]); ?>
        </div>
        <div class="col-md-12">
            <div class="text-center">
                <h3><?= sprintf("%s %s %s", AppLabels::REPORT, AppLabels::PURCHASE, AppLabels::MONTH) ?> <?= AppConstants::$month[$month] ?>
                    <?= AppLabels::YEAR ?> <?= AppConstants::$year[$year] ?> </h3>
            </div>

            <?php if (!empty($purchases)) :
                $weightTotal = 0;
                $dirtyTotal = 0;
                $commissionTotal = 0;
                $laborTotal = 0;
                $stampTotal = 0;
                $cleanTotal = 0; ?>

                <div class="row">
                    <table id="table-item" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center"><?= $purchases[0]->p_date ?></th>
                        </tr>
                        <tr>
                            <th class="text-center" width="15%"><?= AppLabels::SELLER ?></th>
                            <th class="text-center" width="5%"><?= AppLabels::DETAIL ?></th>
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
                                width="15%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN) ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($purchases as $key => $purchase) :
                            $weightTotal += $purchase->getTotalWeight();
                            $dirtyTotal += $purchase->total_dirty;
                            $commissionTotal += $purchase->commission;
                            $laborTotal += $purchase->labor;
                            $stampTotal += $purchase->stamp;
                            $cleanTotal = $dirtyTotal - $commissionTotal - $laborTotal - $stampTotal;

                            ?>
                            <tr>
                                <td class="text-center"><?php Modal::begin([
                                        'id' => 'historySellerModal' . $purchase->seller->id,
                                        'header' => '<h2>Riwayat Penjualan ' . '</h2>',
                                        'toggleButton' => ['label' => $purchase->seller->s_name, 'class' => 'btn transparent'],
                                        'size' => Modal::SIZE_LARGE,
                                    ]);
                                    echo $this->render('historySellerModal', ['model' => $purchase->seller]);
                                    Modal::end(); ?></td>
                                <td class="text-center"> <?php Modal::begin([
                                        'id' => 'purchaseDetailModal' . $purchase->id,
                                        'header' => '<h2>Detail Pembelian ' . '</h2>',
                                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-paperclip"></span>', 'class' => 'btn transparent'],
                                        'size' => Modal::SIZE_LARGE,
                                    ]);
                                    echo $this->render('purchaseDetailModal', ['model' => $purchase]);
                                    Modal::end(); ?>
                                </td>
                                <td class="text-center red-font"><?= Yii::$app->formatter->asInteger($purchase->getTotalWeight()) ?></td>
                                <td class="text-center red-font"><?= Yii::$app->formatter->asCurrency($purchase->total_dirty) ?></td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->commission) ?></td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->labor) ?></td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->stamp) ?></td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->p_other) ?></td>
                                <td class="text-center red-font"><?= Yii::$app->formatter->asCurrency($purchase->total_clean) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="2"
                                class="text-center"><?= sprintf("%s %s", AppLabels::TOTAL, AppLabels::ALL) ?> </td>
                            <td class="text-center yellow"><?= Yii::$app->formatter->asInteger($weightTotal) ?></td>
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
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>
</div>
