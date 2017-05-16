<?php \app\components\SideBar\SideBarAsset::register($this);


use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = [
    'template' => "<li><b>{link}</b></li>\n",
    'label' =>  Yii::$app->session->get('host'),
    'url' => ['/schema'],
];


?>


<div class="sidebar">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => [
                'class' => 'breadcrumb-arrow',
        ],
        'homeLink' => false,
    ]);?>


    <div class="sidebar-content">

        <ul class="schema-list" >

            <?php foreach ($schemaList as $schemaName) { ?>
                <li >
                   <?=Html::a($schemaName, Url::to(['schema/tables', 'schemaName' => $schemaName]))?>
                </li>
            <?php } ?>

        </ul>
    </div>

</div>


