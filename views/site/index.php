<?php

/* @var $this yii\web\View */
/* @var $model app\models\TransactionDetail */

/* @var $modelPurchase app\models\PurchaseDetail */

/* @var $lastPurchases app\models\Purchase */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\components\base\AppConstants;
use app\components\base\AppLabels;
use app\models\Buyer;
use app\models\Seller;
use kartik\select2\Select2;
use kartik\number\NumberControl;

$this->title = 'Dashboard';
?>
<div class="body-content">
    <div class="row">
        <div class="col-md-4">
            <div class="transaction-detail-form">

                <h2 class="page-header no-margin-top"><?= AppLabels::SELL ?> </h2>
                <?php $form = ActiveForm::begin([
                ]); ?>

                <?= $form->field($model, 'transaction_id')
                    ->hiddenInput(['value' => $model->transaction_id])->label(false); ?>

                <?= $form->field($model, 'buyer', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
                    'data' => Buyer::map(),
                    'options' => ['value' => AppConstants::DEFAULT_BUYER, 'class' => 'input-lg form-control', 'placeholder' => '-- Pabrik --'],
                ])->label(false); ?>

                <?= $form->field($model, 'td_type', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
                    'data' => AppConstants::$type,
                    'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Jenis --'],
                ])->label(false); ?>

                <?= $form->field($model, 'td_name', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
                    ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::GROUP])->label(false); ?>

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
                        ])->label(false); ?>

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
                        ])->label(false); ?>

                <?= Html::hiddenInput("action", AppConstants::ACTION_TRANSACTION); ?>

                <div class="form-group">
                    <?= Html::submitButton(AppLabels::SAVE, ['name' => 'submitTransaction', 'class' => 'btn btn-lg btn-success pull-right']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="purchase-form">

                <h2 class="page-header no-margin-top"><?= AppLabels::PURCHASE ?></h2>
                <?php $form = ActiveForm::begin([
                ]); ?>

                <?= $form->field($modelPurchase, 'purchase_id')
                    ->hiddenInput(['value' => $modelPurchase->purchase_id])->label(false); ?>

                <?= Html::hiddenInput("action", AppConstants::ACTION_PURCHASE); ?>

                <?= $form->field($modelPurchase, 'seller', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])->widget(Select2::classname(), [
                    'data' => Seller::map(),
                    'options' => ['class' => 'input-lg form-control', 'placeholder' => '-- Nama Pembeli --'],
                ])->label(false); ?>

                <?= $form->field($modelPurchase, 'pd_name', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
                    ->textInput(['class' => 'form-control text-center input-lg', 'placeholder' => AppLabels::GROUP])->label(false); ?>

                <?= $form->field($modelPurchase, 'pd_rubber_weight', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
                    ->widget(NumberControl::className(),
                        [
                            'model' => $modelPurchase,
                            'displayOptions' => [
                                'placeholder' => AppLabels::WEIGHT,
                                'class' => 'form-control text-center input-lg'
                            ],
                            'maskedInputOptions' => [
                                'groupSeparator' => '.',
                                'radixPoint' => ','
                            ],
                        ])->label(false); ?>

                <?= $form->field($modelPurchase, 'pd_rubber_price', ['template' => AppConstants::ACTIVE_FORM_TEMPLATE_INPUT_COL_FULL])
                    ->widget(NumberControl::className(),
                        [
                            'model' => $modelPurchase,
                            'displayOptions' => [
                                'placeholder' => AppLabels::PRICE,
                                'class' => 'form-control text-center input-lg'
                            ],
                            'maskedInputOptions' => [
                                'groupSeparator' => '.',
                                'radixPoint' => ','
                            ],
                        ])->label(false); ?>

                <div class="col-md-12">
                    <?= NumberControl::widget([
                        'name' => 'other',
                        'displayOptions' => [
                            'placeholder' => AppLabels::OTHER,
                            'class' => 'form-control text-center input-lg'
                        ],
                        'maskedInputOptions' => [
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                    ]) ?>
                </div>

                <div class="text-right">
                    <?= Html::checkbox("transfer", false, ['label' => 'Transfer']); ?>
                    <br/>
                    <?= Html::checkbox("note", false, ['label' => 'Nota Baru']); ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton(AppLabels::SAVE, ['name' => 'submitPurchase', 'class' => 'btn btn-lg btn-success pull-right']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>

        <div class="col-md-4">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= Yii::$app->formatter->asInteger($totalToday) ?> kg</div>
                                <div>Total Pembelian Hari ini</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= Yii::$app->formatter->asInteger($totalMonth) ?> kg</div>
                                <div>Total Pembelian Bulan ini</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?= AppLabels::SELLER ?></th>
                        <th><?= AppLabels::WEIGHT ?></th>
                        <th><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lastPurchases as $key => $purchase) : ?>
                        <tr>
                            <td><?= $purchase->id ?></td>
                            <td><?= $purchase->seller->s_name ?></td>
                            <td><?= Yii::$app->formatter->asInteger($purchase->total_weight) ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($purchase->getTotal()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.col-lg-4 (nested) -->
		
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-right fa-fw"></i> ' . 'Pengeluaran', ['/spending']); ?>
		</div>
    </div>
</div>
