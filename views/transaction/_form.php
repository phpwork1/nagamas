<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use yii\jui\DatePicker;
use app\models\Buyer;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <?= $form->field($model, 'buyer_id', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_9_FULL])->widget(Select2::classname(), [
            'data' => Buyer::map(),
            'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
        ])->label(AppLabels::BUYER, ['class' => AppConstants::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

        <?= $form->field($model, 't_date', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_9_FULL])
            ->widget(
                DatePicker::className(), [
                    'options' => [
                        'class' => 'form-control'
                    ],
                ]
            )
            ->label(AppLabels::DATE, ['class' => AppConstants::ACTIVE_FORM_CLASS_LABEL_COL_3]);
        ?>
    </div>


    <div class="form-group pull-center">
        <?= Html::submitButton(AppLabels::SAVE, ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
