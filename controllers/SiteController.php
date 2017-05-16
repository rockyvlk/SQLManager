<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;



class SiteController extends AppController
{


    /**
     * Displays homepage.
     */
    public function actionIndex() {

        return $this->render('index');
    }


    /**
     * Display login form
     */
    public function actionLogin() {

        $this->layout = "login";

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();




        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            return $this->goHome();
        }


        return $this->render('login', [
            'model' => $form,
        ]);
 }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


}
