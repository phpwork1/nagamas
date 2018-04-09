<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use app\assets\ReportAsset;
use app\models\Purchase;
use kartik\select2\Select2;

ReportAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \app\models\Purchase */
/* @var $month int */
/* @var $year int */
/* @var $form yii\widgets\ActiveForm */

$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = $this->title;
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

        <?php for ($i = 1; $i < 32; $i++) : $date = new DateTime();
            $count = 0;
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
                            <th class="text-center" width="10%"><?= AppLabels::DATE ?></th>
                            <th class="text-center" width="5%"><?= AppLabels::SELLER ?></th>
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
                                width="15%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN) ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  foreach ($purchases as $key => $purchase) :  ?>
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
                                    <td class="text-center"><?= $detail->purchase->seller->s_name ?></td>
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
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-center"><?= AppLabels::TOTAL ?></td>
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
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
