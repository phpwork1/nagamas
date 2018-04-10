<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use app\assets\ReportAsset;
use app\models\Spending;
use kartik\select2\Select2;

ReportAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \app\models\Spending */
/* @var $purchase \app\models\Purchase */
/* @var $month int */
/* @var $year int */
/* @var $form yii\widgets\ActiveForm */

$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::SPENDING);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="spend-report">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-2">
        <?= Html::a(sprintf("%s %s", AppLabels::UPDATE, AppLabels::SPENDING), ['index'], ['class' => 'btn btn-info']) ?>
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
            <h3><?= sprintf("%s %s %s", AppLabels::REPORT, AppLabels::SPENDING, AppLabels::MONTH) ?> <?= AppConstants::$month[$month] ?>
                <?= AppLabels::YEAR ?> <?= AppConstants::$year[$year] ?> </h3>
        </div>

        <?php $model = Spending::getSpendingByMonthYear($month, $year);
        if (!empty($model)) : ?>

            <div class="row">
                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%"><?= AppLabels::DATE ?></th>
                        <th class="text-center" width="15%"><?= AppLabels::NAME ?></th>
                        <th class="text-center" width="15%"><?= AppLabels::VALUE ?></th>
                        <th class="text-center" width="15%"><?= AppLabels::PURCHASE ?></th>
                        <th class="text-center" width="15%"><?= AppLabels::LABOR ?></th>
                        <th class="text-center" width="15%"><?= AppLabels::OTHER ?></th>
                        <th class="text-center" width="15%"><?= AppLabels::DESCRIPTION ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 1; $i < 32; $i++) : $date = new DateTime();
                        $totalPrice = 0;
                        $count = 0;
                        $date = Yii::$app->formatter->asDate($date->setDate($year, $month, $i), AppConstants::FORMAT_DATE_PHP_SHOW_MONTH); ?>

                        <?php foreach ($model as $key => $spending) : ?>
                            <?php if ($spending->s_date == $date) : ?>
                                <?php foreach ($spending->spendingDetails as $keyDetail => $detail) : $totalPrice += $detail->total; ?>
                                    <tr>
                                        <td class="text-center"><?= $count == 0 ? $spending->s_date : '' ?></td>
                                        <td class="text-center"><?= $detail->sd_name ?></td>
                                        <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->total) ?></td>
                                        <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->sd_spend_value) ?></td>
                                        <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->sd_labor) ?></td>
                                        <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->sd_other) ?></td>
                                        <td class="text-center"><?= $detail->sd_ref ?></td>
                                    </tr>
                                <?php $count++; endforeach; ?>
                                <?php endif; ?>
                        <?php endforeach; ?>

                        <?php foreach ($purchase as $keyPurchase => $item) : ?>
                            <?php if ($date == $item->p_date) : $totalPrice += $item->total; ?>
                                <tr>
                                    <td class="text-center"><?= $count == 0 ? $item->p_date : '' ?></td>
                                    <td class="text-center"><?= $item->seller->s_name ?></td>
                                    <td class="text-center"><?= Yii::$app->formatter->asCurrency($item->total) ?></td>
                                    <td class="text-center"><?= Yii::$app->formatter->asCurrency($item->total) ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php $count++; endif; ?>
                        <?php endforeach; ?>

                        <?php if ($count > 0) : ?>
                            <tr>
                                <td colspan="2" class="text-center yellow"><?= AppLabels::TOTAL ?></td>
                                <td class="text-center red-font"><?= Yii::$app->formatter->asCurrency($totalPrice) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
