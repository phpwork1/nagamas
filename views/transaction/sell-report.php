<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use app\assets\ReportAsset;

ReportAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \app\models\Transaction */
/* @var $month int */
/* @var $year int */
/* @var $form yii\widgets\ActiveForm */

$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::SELL);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="transaction-report">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-2 col-md-offset-8">
        <?= Html::dropDownList('month', null, AppConstants::$month, ['id' => 'month-select', 'class' => 'input-lg form-control', 'options' => [$month => ['Selected' => true]]]) ?>
    </div>

    <div class="col-md-2">
        <?= Html::dropDownList('year', null, AppConstants::$year, ['id' => 'year-select', 'class' => 'input-lg form-control', 'options' => [$year => ['Selected' => true]]]) ?>
    </div>

    <div class="col-md-12">
        <div class="text-center">
            <h3>Laporan Penjualan Bulan <?= AppConstants::$month[$month] ?>
                Tahun <?= AppConstants::$year[$year] ?> </h3>
        </div>

        <?php foreach ($model as $key => $transaction) : ?>
            <div class="row">
                <table id="table-item" class="table table-bordered table-hover">
                    <thead>

                    <?php if (!empty($transaction)) : ?>
                        <tr>
                            <th class="text-center" width="10%"><?= AppLabels::DATE ?></th>
                            <th class="text-center" width="10%"><?= AppLabels::BUYER ?></th>
                            <th class="text-center"
                                width="10%"><?= sprintf("%s %s", AppLabels::WEIGHT, AppLabels::RUBBER) ?></th>
                            <th class="text-center"
                                width="15%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::DIRTY) ?></th>
                            <th class="text-center"
                                width="15%"><?= AppLabels::PPH ?></th>
                            <th class="text-center" width="20%"><?= AppLabels::VALUE ?></th>
                            <th width="5%"></th>
                            <th class="text-center" width="10%"><?= AppLabels::GLOBAL_WORD ?></th>
                        </tr>
                    <?php endif; ?>
                    </thead>
                    <tbody>
                    <?php foreach (AppConstants::$type as $keyType => $t) : $weightTotal = 0;
                        $priceTotal = 0;
                        $transactions = $transaction->getTransactionDetailsByType($keyType);
                        ?>
                        <?php if (!empty($transactions)) : ?>
                            <?php foreach ($transactions as $key2 => $detail) : $weightTotal += $detail->td_rubber_weight;
                                $priceTotal += $detail->td_rubber_weight * $detail->td_rubber_price; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td class="text-center"><?php if ($keyType == '1') {
                                        echo $transaction->t_date;
                                    } ?> </td>
                                <td class="text-center"><?= $transaction->buyer->b_name ?></td>
                                <td class="text-center"><?= Yii::$app->formatter->asInteger($weightTotal) ?> </td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($priceTotal) ?> </td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($priceTotal * 0.005) ?></td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency($priceTotal * 0.995) ?></td>
                                <td class="text-center"><?= $t ?></td>
                                <td class="text-center"><?= Yii::$app->formatter->asCurrency(($priceTotal != 0 && $weightTotal != 0) ? $priceTotal / $weightTotal : 0) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>