<?php

namespace app\assets;

use yii\web\AssetBundle;


class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $css = [
        'css/main.css',
        'css/table.css',
    ];
    public $js = [
        'js/jquery.cookie.js',
        'js/main.js',
        'js/table/table.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
