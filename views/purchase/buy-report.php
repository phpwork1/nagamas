<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use app\assets\ReportAsset;
use app\models\Purchase;
use kartik\select2\Select2;
use yii\bootstrap\Modal;

ReportAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \app\models\Purchase */
/* @var $month int */
/* @var $year int */
/* @var $form yii\widgets\ActiveForm */

$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = $this->title;
$count = 0;
?>

<div class="transaction-report">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-2">
        <?= Html::a(sprintf("%s %s", AppLabels::UPDATE, AppLabels::PURCHASE), ['index'], ['class' => 'btn btn-info']) ?>
    </div>
    <div class="col-md-2 col-md-offset-6">
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

        <?php for ($i = 31; $i > 0; $i--) : $date = new DateTime();
            $date->setDate($year, $month, $i);
            $date = Yii::$app->formatter->asDate($date, AppConstants::FORMAT_DB_DATE_PHP);
            $purchases = Purchase::getPurchasesByDate($date);
            $weightTotal = 0;
            $dirtyTotal = 0;
            $commissionTotal = 0;
            $laborTotal = 0;
            $stampTotal = 0;
            $cleanTotal = 0;

            ?>
            <?php if (!empty($purchases)) : ?>

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
                                        'id' => 'historySellerModal' . $count++,
                                        'header' => '<h2>Riwayat Penjualan ' . '</h2>',
                                        'toggleButton' => ['label' => $purchase->seller->s_name, 'class' => 'btn transparent'],
                                        'size' => Modal::SIZE_LARGE,
                                    ]);
                                    echo $this->render('historySellerModal', ['model' => $purchase->seller, 'date' => $purchase->p_date]);
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
        <?php endfor; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
