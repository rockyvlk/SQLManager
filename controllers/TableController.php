<?php

namespace app\controllers;

use Yii;
use app\models\Table;
use app\models\Row;
use app\models\Column;
use app\models\Index;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;


class TableController  extends  AppController {


    public function actionBrowse($schemaName = '', $tableName = '') {

        Row::$table = $tableName;
        Row::$schema = $schemaName;
        Row::$db = $this->schemaDbConnection;

        $table = Row::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $table,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('browse',['dataProvider' => $dataProvider]);
    }


    public function actionStructure($schemaName = '', $tableName = '') {

        $columns = Column::find()
            ->select([
                'COLUMN_NAME',
                'COLUMN_TYPE',
                'COLLATION_NAME',
                'IS_NULLABLE',
                'COLUMN_DEFAULT',
                'EXTRA',
            ])
            ->where([
                'TABLE_SCHEMA' => $schemaName,
                'TABLE_NAME' => $tableName,
            ]);


        $dataProvider = new ActiveDataProvider([
            'query' => $columns,
            'key' => 'COLUMN_NAME',
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $indexes = Index::find()
            ->select(['INDEX_NAME','COLUMN_NAME','INDEX_TYPE','NON_UNIQUE'])
            ->where(['TABLE_SCHEMA' => $schemaName, 'TABLE_NAME' => $tableName]);


        $dataProviderIndex = new ActiveDataProvider([
            'query' => $indexes,
            'pagination' => [
                'pageSize' => 15,
            ],
         ]);


        return $this->render('structure', ['dataProvider' => $dataProvider, 'dataProviderIndex' => $dataProviderIndex]);
    }


    public function actionTruncate($tableName) {

        $table = new Table($this->schemaDbConnection);

        $table->truncateTable($tableName);

        $this->redirect(Yii::$app->request->referrer);
    }


    public function actionSql($schemaName = '', $tableName = '') {

        $query = Yii::$app->request->post('query');

        if($query) {
            $sqlDataProvider = new SqlDataProvider([
                'sql' => $query,
                'db' => $this->schemaDbConnection,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            return $this->render('sql',['sqlDataProvider' => $sqlDataProvider]);
        }

        return $this->render('sql');
    }

    public function actionCreate() {


        return $this->renderAjax('_create_table');
    }

    public function actionDelete($schemaName = '', $tableName = '') {


        $schema = new Table($this->schemaDbConnection);

        if(isset($_REQUEST['selections'])) {
            $selections = $_REQUEST['selections'];
            foreach ($selections as $selection) {
                $schema->deleteTable($selection);
            }
        } else {
            $schema->deleteTable($tableName);
        }

        $this->redirect("/schema/tables/$schemaName");
    }
}