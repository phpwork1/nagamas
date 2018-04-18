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
        <?php foreach ($model->pals as $key => $pal) :
            $nettoTotal += $pal->netto;
            $grandTotal += $pal->total;
            ?>
            <tr>
                <td class="text-center"><?= $date != $pal->p_date ? $pal->p_date : '' ?></td>
                <td class="text-center"><?= $pal->area->a_name ?></td>
                <td class="text-center"><?= $pal->car->c_name ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($pal->p_bruto) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($pal->p_tarra) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($pal->netto) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($pal->p_price) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($pal->total) ?></td>
            </tr>
            <?php $date = $pal->p_date; endforeach; ?>
        </tbody>
    </table>
</div>