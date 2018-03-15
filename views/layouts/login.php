<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 4/12/2017
 * Time: 8:47 PM
 */

use yii\helpers\Html;
use app\widgets\Alert;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?= Yii::getAlias('@web'); ?>/favicon.png" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>

        <title><?= Html::encode($this->title) ?></title>

        <?= $this->head(); ?>
        <!-- </head> -->
    </head>

    <body class="login-layout">

    <?php $this->beginBody() ?>

    <div class="container">
        <?= Alert::widget() ?>
        <!-- Include content pages -->
        <?php echo $content; ?>
    </div>

    <?php $this->endBody(); ?>

    <!-- </body></html> -->
    </body>
    </html>
<?php $this->endPage() ?>