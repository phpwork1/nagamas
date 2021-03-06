<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use kartik\select2\Select2;
use yii\jui\DatePicker;
use app\components\base\AppLabels;
use kartik\number\NumberControl;


/* @var $this yii\web\View */
/* @var $model app\models\Palm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="palm-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'factory', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => AppConstants::$factory,
            'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Silahkan Pilih --'],
        ])->label(null); ?>

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

        <?= $form->field($model, 'p_price', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
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
            <?= Html::submitButton(AppLabels::SAVE, ['class' => 'btn btn-success pull-right']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
