<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 18/4/2018
 * Time: 10:25 AM
 */

/* @var $model \app\models\Palm */

use app\components\base\AppLabels;

?>

<div class="row">
    <table id="table-item" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-center"><?= AppLabels::DATE ?></th>
            <th class="text-center"><?= AppLabels::PRICE ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model as $key => $price) : ?>
            <tr>
                <td class="text-center"><?= Yii::$app->formatter->asDate($price->p_date, \app\components\base\AppConstants::FORMAT_DATE_USER_SHOW_MONTH) ?></td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($price->p_price) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>