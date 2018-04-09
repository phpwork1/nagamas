<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use app\components\base\AppLabels;
use app\models\Seller;
use kartik\select2\Select2;

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
            ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::PRICE])->label(null); ?>

        <?= $form->field($model, 'pd_rubber_price', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::PRICE])->label(null); ?>

        <?= $form->field($model, 'pd_other', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::OTHER])->label(null); ?>


        <?= $form->field($model, 'pd_commission', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => AppConstants::$commission,
            'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
        ])->label(null); ?>

        <?= $form->field($model, 'pd_stamp', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => AppConstants::$stamp,
            'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
        ])->label(null); ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
