<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\components\base\AppLabels;

/* @var $this \yii\web\View */
/* @var $content string */

?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?= Html::a(AppLabels::COMPANY_NAME, Yii::$app->getHomeUrl(), ['class' => 'navbar-brand']) ?>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-left">
        <?=
        Breadcrumbs::widget([
            'homeLink' => ['label' => '<i class="glyphicon glyphicon-home"></i>', 'encode' => false, 'url' => ['/site/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </ul>

    <ul class="nav navbar-top-links navbar-right">
        <li class="navbar-text">
            Hari ini : <?= Yii::$app->formatter->asDate(time(), \app\components\base\AppConstants::FORMAT_DATE_PHP_SHOW_MONTH); ?>
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><?= Html::a('<i class="fa fa-building fa-fw"></i> ' . AppLabels::BUYER, ['/buyer']); ?>
                </li>
                <li><?= Html::a('<i class="fa fa-male fa-fw"></i> ' . AppLabels::SELLER, ['/seller']); ?>
                </li>
                <li class="divider"></li>
                <li><?= Html::a('<i class="fa fa-sign-out fa-fw"></i> ' . 'Logout', ['site/logout'], ['data' => ['method' => 'post']]); ?></li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?= Yii::$app->getHomeUrl() ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-building fa-fw"></i> ' . 'Laporan Pabrik', ['/transaction']); ?>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-dollar fa-fw"></i> ' . 'Penjualan', ['/transaction/sell-report']); ?>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-cart-plus fa-fw"></i> ' . 'Pembelian', ['/purchase/buy-report']); ?>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-cart-plus fa-fw"></i> ' . 'Pengeluaran', ['/spending/spend-report']); ?>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-exchange fa-fw"></i> ' . 'Untung Rugi', ['/site/profit-loss']); ?>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-bank fa-fw"></i> ' . 'Sawit<span class="fa arrow"></span>', '#'); ?>
                    <ul class="nav nav-second-level">
                        <li>
                            <?= Html::a('<i class="fa fa-book fa-fw"></i> ' . 'BAM', ['/bam']); ?>
                        </li>
                        <li>
                            <?= Html::a('<i class="fa fa-book fa-fw"></i> ' . 'PAL', ['/pal']); ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

