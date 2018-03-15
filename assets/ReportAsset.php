<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 14/3/2018
 * Time: 3:32 PM
 */

namespace app\assets;

use yii\web\AssetBundle;


class ReportAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/report.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}