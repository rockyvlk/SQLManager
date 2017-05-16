<?php


namespace app\controllers;

use Yii;
use app\models\Collation;
use app\models\Schema;
use app\models\Table;
use app\models\View;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;


class SchemaController extends AppController {

    public $defaultAction = 'list';

    public function actionList() {


        $schemas = Schema::find()
            ->select(['SCHEMA_NAME', 'DEFAULT_COLLATION_NAME', 'COUNT(TABLE_NAME) AS tableCount'])
            ->joinWith([
                'tables' => function ($query) {
                    $query->onCondition(['!=', 'TABLE_TYPE', 'VIEW']);
                },
                ],false)
            ->groupBy('SCHEMA_NAME');


        $dataProvider = new ActiveDataProvider([
            'query' => $schemas,
            'key' => 'SCHEMA_NAME',
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        return $this->render('list',['dataProvider' => $dataProvider]);
    }


    public function actionTables($schemaName = '') {

        $tables = Table::find()
            ->select(['TABLE_NAME','TABLE_SCHEMA', 'TABLE_ROWS', 'ENGINE','TABLE_COLLATION','(DATA_LENGTH + INDEX_LENGTH) as dataLength','DATA_FREE'])
            ->where(['TABLE_SCHEMA' => $schemaName])
            ->andWhere(['!=', 'TABLE_TYPE', 'VIEW']);



        $dataProvider = new ActiveDataProvider([
            'query' => $tables,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('tables',['dataProvider' => $dataProvider]);
    }


    public function actionViews($schemaName = '') {

        $views = View::find()
            ->select(['TABLE_NAME','TABLE_SCHEMA', 'IS_UPDATABLE'])
            ->where(['TABLE_SCHEMA' => $schemaName]);


        $dataProvider = new ActiveDataProvider([
            'query' => $views,
            'key' => 'TABLE_NAME',
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('views',['dataProvider' => $dataProvider]);
    }

    public function actionCreate() {

        $collations = Collation::getAllCollations();


        $name = Yii::$app->request->get('schemaName');
        $collation = Yii::$app->request->get('collation');



        if(isset($name) && isset($collation)) {
            $schema = new Schema();
            $schema->createSchema($name,$collation);
           $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_create_schema', ['collations' => $collations]);
    }


    public function actionUpdate($schemaName = '') {

        $collations = Collation::getAllCollations();

        $name = Yii::$app->request->get('schemaName');
        $collation = Yii::$app->request->get('collation');

        if(isset($name) && isset($collation)) {
            $schema = new Schema();
            $schema->updateSchema($name,$collation);
            $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_update_schema', ['collations' => $collations, 'schemaName' => $schemaName]);
    }


    public function actionSql($schemaName = '') {



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


    public function actionDelete($schemaName = '') {

        $schema = new Schema();

        if(isset($_REQUEST['selections'])) {
            $selections = $_REQUEST['selections'];
            foreach ($selections as $selection) {
                $schema->deleteSchema($selection);
            }
        } else {
            $schema->deleteSchema($schemaName);
        }

      $this->redirect('/schema/list');
    }

}