<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppConstants;
use app\models\Car;
use app\models\Driver;
use kartik\select2\Select2;
use app\components\base\AppLabels;
use kartik\number\NumberControl;
use yii\jui\DatePicker;
use app\assets\FactoryAsset;
use yii\helpers\Url;
use app\models\Area;


FactoryAsset::register($this);

$baseUrl = Url::base();
echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']);
/* @var $this yii\web\View */
/* @var $model app\models\Pal */
/* @var $form yii\widgets\ActiveForm */
?>

<?= Html::hiddenInput('factory', 'pal', ['id' => 'factory']); ?>

<div class="pal-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'driver_id', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => Driver::map(),
            'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Silahkan Pilih --'],
        ])->label(null); ?>

        <?= $form->field($model, 'car_id', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => Car::map(),
            'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Silahkan Pilih --'],
        ])->label(null); ?>

        <?= $form->field($model, 'p_date', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(
                DatePicker::className(), [
                    'options' => [
                        'class' => 'input-lg form-control date',
                    ],
                ]
            )
            ->label(null);
        ?>

        <?= $form->field($model, 'area_id', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
            'data' => Area::map(),
            'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Silahkan Pilih --'],
        ])->label(null); ?>

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
        <?= $form->field($model, 'p_bruto', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(NumberControl::className(),
                [
                    'model' => $model,
                    'displayOptions' => [
                        'placeholder' => AppLabels::BRUTO,
                        'class' => 'form-control text-center input-lg'
                    ],
                    'maskedInputOptions' => [
                        'groupSeparator' => '.',
                        'radixPoint' => ','
                    ],
                ])->label(null); ?>

        <?= $form->field($model, 'p_tarra', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
            ->widget(NumberControl::className(),
                [
                    'model' => $model,
                    'displayOptions' => [
                        'placeholder' => AppLabels::TARRA,
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
