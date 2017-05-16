<?php \app\components\SideBar\SideBarAsset::register($this);

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = [
    'template' => "<li><b>{link}</b></li>\n",
    'label' => Yii::$app->session->get('host'),
    'url' => ['/schema'],
];
$this->params['breadcrumbs'][] = [
    'label' => $schemaName,
    'url' => ['/schema/tables/'.$schemaName],
];

if( Yii::$app->request->get('tableName') ){

    $tableName = Yii::$app->request->get('tableName');

    $this->params['breadcrumbs'][] = [
        'label' => $tableName,
        'url' => ['/table/browse/'.$schemaName . "/" . $tableName],
    ];
}
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

        <ul class="table-list" >

            <?php foreach ($tableList as $tableName) { ?>
                <li>
                    <?= Html::a($tableName, Url::to(['table/browse', 'schemaName' => $schemaName, 'tableName' => $tableName]))?>

                </li>
            <?php } ?>

        </ul>
    </div>

</div>
