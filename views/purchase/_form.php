<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use app\components\base\AppLabels;
use yii\jui\DatePicker;
use app\models\Seller;
use kartik\select2\Select2;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($model, 'p_date', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(
                DatePicker::className(), [
                    'options' => [
                        'class' => 'input-lg form-control'
                    ],
                ]
            )
            ->label(null);
        ?>


        <?= $form->field($model, 'seller_id', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => Seller::map(),
            'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Silahkan Pilih --'],
        ])->label(null); ?>

        <?= $form->field($model, 'p_commission', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => AppConstants::$commission,
            'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Silahkan Pilih --'],
        ])->label(null); ?>

        <?= $form->field($model, 'p_stamp', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => AppConstants::$stamp,
            'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Silahkan Pilih --'],
        ])->label(null); ?>

        <?= $form->field($model, 'p_other', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(NumberControl::className(),
                [
                    'model' => $model,
                    'displayOptions' => [
                        'class' => 'form-control text-center input-lg'
                    ],
                    'maskedInputOptions' => [
                        'groupSeparator' => '.',
                        'radixPoint' => ','
                    ],
                ])->label(null); ?>



    </div>

    <div class="form-group">
        <?= Html::submitButton(AppLabels::SAVE, ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
