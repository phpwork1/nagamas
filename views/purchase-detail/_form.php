<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purchase_id')->textInput() ?>

    <?= $form->field($model, 'seller_id')->textInput() ?>

    <?= $form->field($model, 'pd_rubber_weight')->textInput() ?>

    <?= $form->field($model, 'pd_rubber_price')->textInput() ?>

    <?= $form->field($model, 'pd_commission')->textInput() ?>

    <?= $form->field($model, 'pd_stamp')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
