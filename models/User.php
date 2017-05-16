<?php


namespace app\models;


use Yii;
use yii\base\Object;
use yii\web\IdentityInterface;


class User extends Object implements IdentityInterface {

    private $id = 1;
    public $username;
    public $password;
    public $host;
    public $port;
    public $errorMessage;



    public function __construct($username,$password,$host,$port) {
        $this->username=$username;
        $this->password=$password;
        $this->host=$host;
        $this->port=$port;
    }




    public static function findIdentity($id) {

             return (Yii::$app->session->get('id')) ?
                 new User(
                     (Yii::$app->session->get('username')),
                     (Yii::$app->session->get('password')),
                     (Yii::$app->session->get('host')),
                     (Yii::$app->session->get('port'))
                 ) : null;
    }


    public static function findIdentityByAccessToken($token, $type = null) {}


    public static function findByUsername($username) {}


    public function getId() {
        return $this->id;
    }


    public function getAuthKey(){}


    public function validateAuthKey($authKey) {}



    /*
     * Authenticates the user against database
     * @return bool
     */
    public function authenticate() {

        $db = new \yii\db\Connection([
            'dsn' =>  'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=information_schema',
            'username' => $this->username,
            'password' => $this->password
        ]);


        try {


           $db->open();


            Yii::$app->session->set('id',$this->id);
            Yii::$app->session->set('username',$this->username);
            Yii::$app->session->set('password',$this->password);
            Yii::$app->session->set('host',$this->host);
            Yii::$app->session->set('port',$this->port);



        } catch (\yii\db\Exception $error) {

            $this->errorMessage = $error->getMessage();


            return false;
        }

        return true;

    }

}