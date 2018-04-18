<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 18/4/2018
 * Time: 11:02 AM
 */

use app\components\base\AppLabels;

/* @var $model \app\models\Driver */
?>

<div class="row">
    <?php
    $nettoTotal = 0;
    $grandTotal = 0;
    $date = 0;
    ?>
    <table id="table-item" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-center" width="10%"><?= AppLabels::DATE ?></th>
            <th class="text-center" width="10%"><?= AppLabels::NAME ?></th>
            <th class="text-center"
                width="10%"><?= sprintf("%s %s", AppLabels::PLAT, AppLabels::CAR) ?></th>
            <th class="text-center"
                width="10%"><?= AppLabels::BRUTO ?></th>
            <th class="text-center" width="10%"><?= AppLabels::TARRA ?></th>
            <th class="text-center" width="10%"><?= AppLabels::NETTO ?></th>
            <th class="text-center" width="10%"><?= AppLabels::PRICE ?></th>
            <th class="text-center"
                width="30%"><?= AppLabels::TOTAL ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->bams as $key => $bam) :
            $nettoTotal += $bam->netto;
            $grandTotal += $bam->total;
            ?>
            <tr>
                <td class="text-center"><?= $date != $bam->b_date ? $bam->b_date : '' ?></td>
                <td class="text-center"><?= $bam->area->a_name ?></td>
                <td class="text-center"><?= $bam->car->c_name ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($bam->b_bruto) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($bam->b_tarra) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($bam->netto) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($bam->b_price) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($bam->total) ?></td>
            </tr>
            <?php $date = $bam->b_date; endforeach; ?>
        </tbody>
    </table>
</div>