<?php

namespace app\components\SideBar;

use yii\web\AssetBundle;


class SideBarAsset extends AssetBundle {
    public $sourcePath = '@app/components/SideBar';
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $css = [
        'css/sidebar.css',
    ];
    public $js = [
        'js/sidebar.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
    ];
}