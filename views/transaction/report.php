<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use app\assets\ReportAsset;
use kartik\select2\Select2;

ReportAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \app\models\Transaction */
/* @var $month int */
/* @var $year int */
/* @var $form yii\widgets\ActiveForm */
$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::TRANSACTION);
$this->params['breadcrumbs'][] = ['label' => AppLabels::FACTORY_REPORT, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="transaction-report">

    <?php $form = ActiveForm::begin(); ?>

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
            <h3>Laporan Transaksi Bulan <?= AppConstants::$month[$month] ?>
                Tahun <?= AppConstants::$year[$year] ?> </h3>
        </div>

        <?php foreach ($model as $key => $transaction) : ?>
            <?php foreach (AppConstants::$type as $keyType => $t) : $weightTotal = 0;
                $priceTotal = 0;
                $transactions = $transaction->getTransactionDetailsByType($keyType);
                ?>
                <div class="row">
                    <table id="table-item" class="table table-bordered table-hover">
                        <thead>

                        <?php if (!empty($transactions)) : ?>
                            <tr>
                                <th colspan="5"><?= AppLabels::DATE ?> <?= sprintf("%s (%s)", $transaction->t_date, $t); ?></th>
                            </tr>

                            <tr>
                                <th class="text-center" width="10%"><?= AppLabels::NUMBER_SHORT ?></th>
                                <th class="text-center"
                                    width="20%"><?= sprintf("%s %s", AppLabels::WEIGHT, AppLabels::RUBBER) ?></th>
                                <th class="text-center"
                                    width="30%"><?= sprintf("%s / %s", AppLabels::PRICE, AppLabels::KG) ?></th>
                                <th class="text-center" width="40%"><?= AppLabels::TOTAL ?></th>
                            </tr>
                        <?php endif; ?>
                        </thead>
                        <tbody>
                        <?php foreach ($transactions as $key2 => $detail) : $weightTotal += $detail->td_rubber_weight;
                            $priceTotal += $detail->td_rubber_weight * $detail->td_rubber_price; ?>
                            <tr>
                                <td class="text-center"><?= $detail->td_name ?> </td>
                                <td class="text-center"><?= Yii::$app->formatter->asInteger($detail->td_rubber_weight) ?> </td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->td_rubber_price) ?> </td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->td_rubber_weight * $detail->td_rubber_price) ?> </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (!empty($transactions)) : ?>
                            <tr>
                                <td class="text-center"><?= AppLabels::TOTAL ?> </td>
                                <td class="text-center"><?= Yii::$app->formatter->asInteger($weightTotal) ?> </td>
                                <td></td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($priceTotal) ?> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center"><?= AppLabels::TAX ?> </td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($priceTotal * 0.005) ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center"><?= AppLabels::TOTAL ?> </td>
                                <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($priceTotal * 0.995) ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (!empty($transactions)) : ?>
                    <hr/>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
