<?php

namespace app\components\SideBar;

use app\models\Schema;
use app\models\Table;
use yii\base\Widget;
use Yii;


class SideBarWidget extends Widget {



    public function init() {
        parent::init();
    }

    public function run() {


        $schemaList = Schema::find()
            ->select('SCHEMA_NAME')
            ->asArray()
            ->column();


        $schemaName = Yii::$app->request->get('schemaName');

       if($schemaName) {

           $tableList = Table::find()
               ->select('TABLE_NAME')
               ->where(['TABLE_SCHEMA' => $schemaName])
               ->andWhere(['!=', 'TABLE_TYPE', 'VIEW'])
               ->asArray()
               ->column();

           return $this->render('side-bar-table' , ['schemaName' => $schemaName , 'tableList' => $tableList]);
       }

       return $this->render('side-bar-db' , ['schemaList' => $schemaList]);
    }

}