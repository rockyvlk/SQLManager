<?php


namespace app\controllers;

use Yii;
use yii\db\Connection;
use yii\web\Controller;


class AppController extends Controller {

    public $schemaDbConnection;
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }


    public function beforeAction($action) {
        $schemaName = Yii::$app->request->get('schemaName');

        $this->enableCsrfValidation = false;

        if(!Yii::$app->user->isGuest) {

             $user = Yii::$app->user->identity;


            Yii::$app->db->dsn = 'mysql:host=' . $user->host . ';port=' . $user->port . ';dbname=information_schema';
            Yii::$app->db->username = $user->username;
            Yii::$app->db->password = $user->password;

        }



        if(isset($schemaName)){
            $this->schemaDbConnection = new Connection([
                'dsn' =>  'mysql:host=' . $user->host . ';port=' . $user->port . ';dbname=' . $schemaName,
                'username' =>  Yii::$app->db->username,
                'password' => Yii::$app->db->password ,
                'charset' => 'utf8',
            ]);
        }


        return parent::beforeAction($action);
    }


}