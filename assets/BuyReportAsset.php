<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 27/5/2018
 * Time: 11:45 AM
 */

namespace app\assets;
use yii\web\AssetBundle;

class BuyReportAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/stringbuilder.js',
        'js/action-view/buy-report.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}