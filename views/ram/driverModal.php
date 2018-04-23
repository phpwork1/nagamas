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
        <?php foreach ($model->rams as $key => $ram) :
            $nettoTotal += $ram->netto;
            $grandTotal += $ram->total;
            ?>
            <tr>
                <td class="text-center"><?= $date != $ram->r_date ? $ram->r_date : '' ?></td>
                <td class="text-center"><?= $ram->area->a_name ?></td>
                <td class="text-center"><?= $ram->car->c_name ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($ram->r_bruto) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($ram->r_tarra) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asInteger($ram->netto) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($ram->r_price) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($ram->total) ?></td>
            </tr>
            <?php $date = $ram->r_date; endforeach; ?>
        </tbody>
    </table>
</div>