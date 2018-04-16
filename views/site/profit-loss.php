<?php

use yii\widgets\ActiveForm;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use app\assets\ReportAsset;
use app\models\Purchase;
use kartik\select2\Select2;
use app\models\Transaction;

ReportAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \app\models\Purchase */
/* @var $month int */
/* @var $year int */
/* @var $buyer int */
/* @var $form yii\widgets\ActiveForm */

$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = $this->title;

$purchaseGrandTotal = 0;
$profitGrandTotal = 0;
?>

<div class="transaction-report">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-2 col-md-offset-6">
        <?= Select2::widget([
            'name' => 'buyer',
            'value' => $buyer,
            'data' => \app\models\Buyer::map(),
            'options' => ['id' => 'buyer-select', 'class' => 'input-lg form-control']
        ]); ?>
    </div>

    <div class="col-md-2">
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


        <div class="row">
            <table id="table-item" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center" width="10%"><?= AppLabels::DATE ?></th>
                    <th class="text-center" width="20%"><?= AppLabels::SELL ?></th>
                    <th class="text-center" width="20%"><?= AppLabels::PURCHASE ?></th>
                    <th class="text-center" width="10%"><?= AppLabels::LABOR ?></th>
                    <th class="text-center" width="20%"><?= AppLabels::STAMP ?></th>
                    <th class="text-center" width="20%"><?= AppLabels::PROFIT ?></th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 1; $i < 32; $i++) : $date = new DateTime();
                    $date->setDate($year, $month, $i);
                    $date = Yii::$app->formatter->asDate($date, AppConstants::FORMAT_DB_DATE_PHP);
                    $purchaseTotal = Purchase::getTotalPriceByDate($date);
                    $transactionTotal = Transaction::getTotalCleanByDate($buyer, Yii::$app->formatter->asDate($date, AppConstants::FORMAT_DB_DATE_PHP));
                    $transactionWeight = Transaction::getTotalWeightByDate($buyer, Yii::$app->formatter->asDate($date, AppConstants::FORMAT_DB_DATE_PHP));
                    $profit = $transactionTotal - $purchaseTotal - ($transactionWeight * AppConstants::DEFAULT_PROFIT_LOSS_LABOR) - AppConstants::DEFAULT_PROFIT_LOSS_STAMP;

                    ?>
                    <?php if (!empty($purchaseTotal) && !empty($transactionTotal) && !empty($transactionWeight)) : $purchaseGrandTotal += $purchaseTotal;
                        $profitGrandTotal += $profit; ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($transactionTotal) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchaseTotal) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($transactionWeight * AppConstants::DEFAULT_PROFIT_LOSS_LABOR) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency(AppConstants::DEFAULT_PROFIT_LOSS_STAMP) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($profit) ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endfor; ?>
                <tr>
                    <td class="text-center" colspan="2"><?= AppLabels::TOTAL ?></td>
                    <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchaseGrandTotal) ?></td>
                    <td class="text-center" colspan="2"></td>
                    <td class="text-center"><?= Yii::$app->formatter->asCurrency($profitGrandTotal) ?></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
