<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use app\components\base\AppLabels;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\SpendingDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spending-detail-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="col-md-6">
        <?= $form->field($model, 'sd_name', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::NAME])->label(null); ?>


        <?= $form->field($model, 'sd_spend_value', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(NumberControl::className(),
                [
                    'model' => $model,
                    'displayOptions' => [
                        'placeholder' => AppLabels::PURCHASE,
                        'class' => 'form-control text-center input-lg'
                    ],
                ])->label(null); ?>

        <?= $form->field($model, 'sd_labor', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(NumberControl::className(),
                [
                    'model' => $model,
                    'displayOptions' => [
                        'placeholder' => AppLabels::LABOR,
                        'class' => 'form-control text-center input-lg'
                    ],
                    'maskedInputOptions' => [
                        'groupSeparator' => '.',
                        'radixPoint' => ','
                    ],
                ])->label(null); ?>

        <?= $form->field($model, 'sd_other', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(NumberControl::className(),
                [
                    'model' => $model,
                    'displayOptions' => [
                        'placeholder' => AppLabels::OTHER,
                        'class' => 'form-control text-center input-lg'
                    ],
                    'maskedInputOptions' => [
                        'groupSeparator' => '.',
                        'radixPoint' => ','
                    ],
                ])->label(null); ?>
        <?= $form->field($model, 'sd_ref', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::DESCRIPTION])->label(null); ?>

        <div class="form-group">
            <?= Html::submitButton(AppLabels::SAVE, ['class' => 'btn btn-success pull-right']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
