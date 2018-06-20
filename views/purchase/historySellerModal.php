<?php

use app\components\base\AppLabels;
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $id int */
/* @var $date string */
$baseUrl = Url::base();
echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']);
?>


<div id="tables">
    <?php for ($i = 0; $i < 5; $i++) : ?>
        <div class="row">
            <img class="loading-spinner-<?= $i ?>" src="./../../web/img/ajax-loader.gif">
            <table  class="table table-bordered table-hover hide table-item-<?= $i ?>">
                <thead>
                <tr>
                </tr>
                <tr>
                    <th class="text-center" width="10%"><?= AppLabels::GROUP ?></th>
                    <th class="text-center"
                        width="25%"><?= sprintf("%s %s", AppLabels::WEIGHT, AppLabels::RUBBER) ?></th>
                    <th class="text-center"
                        width="25%"><?= sprintf("%s %s", AppLabels::PRICE, AppLabels::RUBBER) ?></th>
                    <th class="text-center" width="40%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::DIRTY) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center"><?= AppLabels::TOTAL ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center"> <?= AppLabels::COMMISSION ?> </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center"> <?= AppLabels::LABOR ?> </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center"> <?= AppLabels::STAMP ?> </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center"> <?= AppLabels::OTHER ?> </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center"> <?= sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN) ?> </td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php endfor; ?>
</div>