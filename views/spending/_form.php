<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use app\components\base\AppLabels;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Spending */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($model, 's_date', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(
                DatePicker::className(), [
                    'options' => [
                        'class' => 'input-lg form-control',
                    ],
                ]
            )
            ->label(null);
        ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton(AppLabels::SAVE, ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
