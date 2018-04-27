<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\base\AppLabels;
use app\components\base\AppConstants;
use app\assets\ReportAsset;
use kartik\select2\Select2;
use yii\bootstrap\Modal;

ReportAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \app\models\Bam */
/* @var $price \app\models\Palm */
/* @var $month int */
/* @var $year int */
/* @var $form yii\widgets\ActiveForm */

$this->title = sprintf('%s %s', AppLabels::REPORT, AppLabels::BAM_LIST);
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="bam-report">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-2">
        <?= Html::a(sprintf("%s %s", AppLabels::UPDATE, AppLabels::BAM_LIST), ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <div class="col-md-2 col-md-offset-1">
        <?= Html::a(sprintf("%s %s", AppLabels::DOWNLOAD, AppLabels::EXCEL), ['export', 'month' => $month, 'year' => $year], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="col-md-2 col-md-offset-1">
        <?php Modal::begin([
            'id' => 'priceModal',
            'header' => '<h2>Daftar Harga ' . '</h2>',
            'toggleButton' => ['label' => sprintf("<span class='fa fa-dollar'></span> %s %s", AppLabels::VIEW, AppLabels::PRICE), 'class' => 'btn btn-success'],
            'size' => Modal::SIZE_LARGE,
        ]);
        echo $this->render('priceModal', ['model' => $price]);
        Modal::end(); ?>
    </div>

    <div class="col-md-2">
        <?= Select2::widget([
            'name' => 'month',
            'value' => $month,
            'data' => AppConstants::$month,
            'options' => ['id' => 'month-select', 'class' => 'input-lg form-control']
        ]); ?>
    </div>

    <div class="col-md-2">
        <?= Select2::widget([
            'name' => 'year',
            'value' => $year,
            'data' => AppConstants::$year,
            'options' => ['id' => 'year-select', 'class' => 'input-lg form-control']
        ]); ?>
    </div>

    <div class="col-md-12">
        <div class="text-center">
            <h3><?= sprintf("%s %s %s", AppLabels::REPORT, AppLabels::BAM_LIST, AppLabels::MONTH) ?> <?= AppConstants::$month[$month] ?>
                <?= AppLabels::YEAR ?> <?= AppConstants::$year[$year] ?> </h3>
        </div>

        <?php if (!empty($model)) :
            $nettoTotal = 0;
            $grandTotal = 0;
            $date = 0;
            ?>
            <div class="row">
                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%"><?= AppLabels::DATE ?></th>
                        <th class="text-center" width="10%"><?= AppLabels::NAME ?></th>
                        <th class="text-center"
                            width="10%"><?= sprintf("%s %s", AppLabels::NAME, AppLabels::DRIVER) ?></th>
                        <th class="text-center"
                            width="10%"><?= sprintf("%s %s", AppLabels::PLAT, AppLabels::CAR) ?></th>
                        <th class="text-center"
                            width="10%"><?= AppLabels::BRUTO ?></th>
                        <th class="text-center" width="10%"><?= AppLabels::TARRA ?></th>
                        <th class="text-center" width="10%"><?= AppLabels::NETTO ?></th>
                        <th class="text-center" width="10%"><?= AppLabels::PRICE ?></th>
                        <th class="text-center"
                            width="20%"><?= AppLabels::TOTAL ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model as $key => $bam) :
                        $nettoTotal += $bam->netto;
                        $grandTotal += $bam->total;
                        ?>
                        <tr>
                            <td class="text-center"><?= $date!=$bam->b_date ? $bam->b_date : '' ?></td>
                            <td class="text-center"><?php Modal::begin([
                                    'id' => 'areaModal' . $bam->area->id,
                                    'header' => '<h2> Detail Daerah ' . $bam->area->a_name . ' </h2>',
                                    'toggleButton' => ['label' => $bam->area->a_name, 'class' => 'btn transparent'],
                                    'size' => Modal::SIZE_LARGE,
                                ]);
                                echo $this->render('areaModal', ['model' => $bam->area]);
                                Modal::end(); ?></td>
                            <td class="text-center"><?php Modal::begin([
                                    'id' => 'driverModal' . $bam->driver->id,
                                    'header' => '<h2> Detail Supir ' . $bam->driver->d_name . ' </h2>',
                                    'toggleButton' => ['label' => $bam->driver->d_name, 'class' => 'btn transparent'],
                                    'size' => Modal::SIZE_LARGE,
                                ]);
                                echo $this->render('driverModal', ['model' => $bam->driver]);
                                Modal::end(); ?></td>
                            <td class="text-center"><?php Modal::begin([
                                    'id' => 'carModal' . $bam->car->id,
                                    'header' => '<h2> Detail Mobil ' . $bam->car->c_name . ' </h2>',
                                    'toggleButton' => ['label' => $bam->car->c_name, 'class' => 'btn transparent'],
                                    'size' => Modal::SIZE_LARGE,
                                ]);
                                echo $this->render('carModal', ['model' => $bam->car]);
                                Modal::end(); ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asInteger($bam->b_bruto) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asInteger($bam->b_tarra) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asInteger($bam->netto) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($bam->b_price) ?></td>
                            <td class="text-center"><?= Yii::$app->formatter->asCurrency($bam->total) ?></td>
                        </tr>
                    <?php $date = $bam->b_date; endforeach; ?>
                    <tr>
                        <td colspan="6"
                            class="text-center"><?= AppLabels::TOTAL ?> </td>
                        <td class="text-center red-font"><?= Yii::$app->formatter->asInteger($nettoTotal) ?></td>
                        <td></td>
                        <td class="text-center red-font"><?= Yii::$app->formatter->asCurrency($grandTotal) ?></td>
                    </tr>
                    <tr>
                        <td colspan="5"
                            class="text-center"></td>
                        <td colspan="3" class="text-center yellow"><?= AppLabels::TAX ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($grandTotal * (AppConstants::DEFAULT_PALM_TAX/100)) ?></td>
                    </tr>
                    <tr>
                        <td colspan="5"
                            class="text-center"></td>
                        <td colspan="3" class="text-center yellow"><?= AppLabels::PALM_VILLAGE_FEE ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($nettoTotal*AppConstants::DEFAULT_PALM_VILLAGE_FEE) ?></td>
                    </tr>
                    <tr>
                        <td colspan="5"
                            class="text-center"></td>
                        <td colspan="3" class="text-center yellow">Grand <?= AppLabels::TOTAL ?></td>
                        <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($grandTotal-($grandTotal*AppConstants::DEFAULT_PALM_TAX/100)-($nettoTotal*AppConstants::DEFAULT_PALM_VILLAGE_FEE)) ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
