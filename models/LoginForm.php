<?php

namespace app\models;

use Yii;
use yii\base\Model;



class LoginForm extends  Model{

    public $username;
    public $password= '';
    public $host = 'localhost';
    public $port = '3306';
    public $rememberMe = true;


    public function rules() {
        return [
            // username and password are both required
            [['username', 'host'], 'required'],

            ['port', 'number',
                'min' => 1,
                'max' => 65535
            ],
            // set default MySQL port if nothing specified
            ['port', 'default',
                'value' => 3306
            ],
            // password needs to be authenticated
             ['password', 'authenticate','skipOnEmpty' => false],

        ];
    }

    public function attributeLabels()
    {
        return array(
            'host'=>Yii::t('app','Host'),
            'port'=>Yii::t('app','Port'),
            'username'=>Yii::t('app','User'),
            'password'=>Yii::t('app','Password'),
        );
    }



    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {

        if (!$this->hasErrors()) {

            $user = new User($this->username,$this->password, $this->host, $this->port);


            if($user->authenticate()) {

                 Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
                 return true;

            } else {

               $this->addError('connection-error',$user->errorMessage);

                return false;
            }

        }


    }


}