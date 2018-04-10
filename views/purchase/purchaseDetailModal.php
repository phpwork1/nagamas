<?php

use app\components\base\AppLabels;

/* @var $model \app\models\Purchase */

?>


<div class="row">
    <table id="table-item" class="table table-bordered table-hover">
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
            <?php foreach($model->purchaseDetails as $key => $detail) : ?>
                <tr>
                   <td class="text-center"><?= $detail->pd_name ?></td>
                   <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->pd_rubber_price) ?></td>
                   <td class="text-center"><?= Yii::$app->formatter->asInteger($detail->pd_rubber_weight) ?></td>
                   <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->total) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
