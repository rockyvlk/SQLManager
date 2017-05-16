<?php

namespace app\components\ContentNavBar;

use Yii;
use yii\base\Widget;



class ContentNavBarWidget extends Widget {

    public function init() {
        parent::init();
    }

    public function run() {

        $schemaName = Yii::$app->request->get('schemaName');
        $tableName = Yii::$app->request->get('tableName');


        if($tableName) {
            return $this->render('table-nav', ['schemaName' => $schemaName , 'tableName' => $tableName]);
        } elseif ($schemaName) {
            return $this->render('schema-nav', ['schemaName' => $schemaName]);
        }

    }
}