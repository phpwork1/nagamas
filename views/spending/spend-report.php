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
/* @var $model \app\models\Spending */
/* @var $month int */
/* @var $year int */
/* @var $form yii\widgets\ActiveForm */

$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::PURCHASE);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="spend-report">

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
    </div>

    <?php ActiveForm::end(); ?>

</div>
