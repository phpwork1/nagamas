<?php

use app\components\base\AppLabels;

/* @var $model \app\models\Purchase */

?>

<div class="row">

    <table class="table table-bordered hide table-hover table-detail">
        <thead>
        <tr>
            <th class="text-center" width="10%"> <?= AppLabels::GROUP ?></th>
            <th class="text-center"
                width="25%"><?= sprintf("%s %s", AppLabels::PRICE, AppLabels::RUBBER) ?></th>
            <th class="text-center"
                width="20%"><?= sprintf("%s %s", AppLabels::WEIGHT, AppLabels::RUBBER) ?></th>
            <th class="text-center"
                width="40%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::DIRTY) ?></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <img class="loading-spinner" src="./../../web/img/ajax-loader.gif">
</div>

