<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\components\SideBar\SideBarWidget;
use app\components\ContentNavBar\ContentNavBarWidget;
use yii\widgets\Pjax;

AppAsset::register($this);

$this->title = 'SQLManager';
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">

        <?php
        NavBar::begin([
            'brandLabel' => 'SQLManager',
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => [
                'class' => 'navbar-brand',
            ],
            'innerContainerOptions' => [
                'class'=>'container-fluid'
            ],
            'options' => [
                'class' => 'navbar navbar-inverse navbar-static-top ',

            ],

        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')' , 'url' => ['/site/logout']],

            ],
        ]);
        NavBar::end();
        ?>



        <?php Pjax::begin();?>

        <?=  SideBarWidget::widget(); ?>

        <?=  ContentNavBarWidget::widget(); ?>


        <div id="content"  class="content-container">
            <?= $content ?>
        </div>


        <?php Pjax::end();?>


    </div>



   <div class="modal remote fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>


    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
