<?php

namespace app\components\SqlRequest;

use yii\web\AssetBundle;

class SqlRequestAsset extends AssetBundle{

    public $sourcePath = '@app/components/SqlRequest';
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $css = [
        'css/sql-request.css',
    ];
    public $js = [
        'js/ace.js',
        'js/mode-sql.js',
        'js/theme-github.js',
        'js/ext-textarea.js',
        'js/sql-request.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}