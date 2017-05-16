<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Login';
$this->registerCssFile('/css/login.css', ['depends' => ['app\assets\AppAsset']]);

?>


<div class="login">



    <h1>Login</h1>



    <?php
        if (isset($model->errors['connection-error'])) {
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-danger'
                ],
                'body' => $model->getFirstError('connection-error'),
            ]);
        }
    ?>


    <?php $form = ActiveForm::begin() ?>


    <?= $form->field($model, 'username', [
            'inputOptions' => [
              'class' => 'login-input',
              'placeholder'  => 'User',
            ],
    ])->label(false); ?>

    <?= $form->field($model, 'password', [
        'inputOptions' => [
            'class' => 'login-input',
            'placeholder'  => 'Password',
        ],
    ])->passwordInput()->label(false); ?>

    <?= $form->field($model, 'host', [
        'inputOptions' => [
            'class' => 'login-input',
            'placeholder'  => 'Host',
        ],
    ])->label(false); ?>

    <?= $form->field($model, 'port', [
        'inputOptions' => [
            'class' => 'login-input',
            'placeholder'  => 'Port',
        ],
    ])->label(false); ?>



    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-large']) ?>


    <?php ActiveForm::end(); ?>




</div>
