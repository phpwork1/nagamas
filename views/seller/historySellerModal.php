<?php

use app\components\base\AppLabels;

/* @var $model \app\models\Seller */


?>


<div class="row">
    <?php foreach ($model->purchases as $key => $purchase) :
        $count = 0;
        ?>
        <table id="table-item" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th class="text-center" colspan="2"><?= $purchase->p_date ?></th>
            </tr>
            <tr>
                <th class="text-center" width="10%"><?= AppLabels::GROUP ?></th>
                <th class="text-center"
                    width="25%"><?= sprintf("%s %s", AppLabels::WEIGHT, AppLabels::RUBBER) ?></th>
                <th class="text-center"
                    width="25%"><?= sprintf("%s %s", AppLabels::PRICE, AppLabels::RUBBER) ?></th>
                <th class="text-center"
                    width="40%"><?= sprintf("%s %s", AppLabels::VALUE, AppLabels::DIRTY) ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($purchase->purchaseDetails as $keyDetail => $detail) : ?>
                <tr>
                    <td class="text-center"><?= $detail->pd_name ?></td>
                    <td class="text-center"><?= Yii::$app->formatter->asInteger($detail->pd_rubber_weight) ?></td>
                    <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->pd_rubber_price) ?></td>
                    <td class="text-center"><?= Yii::$app->formatter->asCurrency($detail->total) ?></td>
                </tr>
                <?php $count++; endforeach; ?>
            <tr>
                <td class="text-center"><?= AppLabels::TOTAL ?></td>
                <td class="text-center yellow"><?= Yii::$app->formatter->asInteger($purchase->total_weight) ?></td>
                <td></td>
                <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($purchase->total_dirty) ?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-center"> <?= AppLabels::COMMISSION ?> </td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->commission) ?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-center"> <?= AppLabels::LABOR ?> </td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->labor) ?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-center"> <?= AppLabels::STAMP ?> </td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->stamp) ?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-center"> <?= AppLabels::OTHER ?> </td>
                <td class="text-center"><?= Yii::$app->formatter->asCurrency($purchase->p_other) ?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-center"> <?= sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN) ?> </td>
                <td class="text-center yellow"><?= Yii::$app->formatter->asCurrency($purchase->total_clean) ?></td>
            </tr>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>