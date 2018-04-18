<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 17/4/2018
 * Time: 3:42 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class FactoryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/factory.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}