<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'td_type')->widget(Select2::classname(), [
        'data' => AppConstants::$type,
        'options' => ['class' => 'form-control', 'placeholder' => '--Silahkan Pilih--'],
    ])->label(null); ?>


    <?= $form->field($model, 'td_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'td_rubber_weight')->textInput() ?>

    <?= $form->field($model, 'td_rubber_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
