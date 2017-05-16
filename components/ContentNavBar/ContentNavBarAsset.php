<?php

namespace app\components\ContentNavBar;

use yii\web\AssetBundle;

class ContentNavBarAsset extends AssetBundle {
    public $sourcePath = '@app/components/ContentNavBar';
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $css = [
        'css/contentbar.css',
    ];
    public $js = [
        'js/contentbar.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}