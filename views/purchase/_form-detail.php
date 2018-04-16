<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use app\components\base\AppLabels;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-detail-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="col-md-6">
        <?= $form->field($model, 'pd_name', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::GROUP])->label(null); ?>


        <?= $form->field($model, 'pd_rubber_weight', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
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

        <?= $form->field($model, 'pd_rubber_price', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
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
