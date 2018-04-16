<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use kartik\select2\Select2;
use kartik\number\NumberControl;
use app\components\base\AppLabels;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-detail-form">

    <?php $form = ActiveForm::begin(); ?>

	<div class="col-md-6">
    <?= $form->field($model, 'td_type', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
        ->widget(Select2::classname(), [
        'data' => AppConstants::$type,
        'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
    ])->label(null); ?>


    <?= $form->field($model, 'td_name', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
        ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::NAME])->label(null); ?>


    <?= $form->field($model, 'td_rubber_weight', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
        ->widget(NumberControl::className(),
            [
                'model' => $model,
                'displayOptions' => [
                    'placeholder' => AppLabels::WEIGHT,
                    'class' => 'form-control text-center input-lg'
                ],
                'maskedInputOptions' => [
                    'groupSeparator' => '.',
                    'radixPoint' => ','
                ],
            ])->label(null); ?>

    <?= $form->field($model, 'td_rubber_price', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
        ->widget(NumberControl::className(),
            [
                'model' => $model,
                'displayOptions' => [
                    'placeholder' => AppLabels::PRICE,
                    'class' => 'form-control text-center input-lg'
                ],
                'maskedInputOptions' => [
                    'groupSeparator' => '.',
                    'radixPoint' => ','
                ],
            ])->label(null); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
