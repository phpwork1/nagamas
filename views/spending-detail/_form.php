<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SpendingDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spending-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'spending_id')->textInput() ?>

    <?= $form->field($model, 'sd_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sd_spend_value')->textInput() ?>

    <?= $form->field($model, 'sd_labor')->textInput() ?>

    <?= $form->field($model, 'sd_other')->textInput() ?>

    <?= $form->field($model, 'sd_ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
