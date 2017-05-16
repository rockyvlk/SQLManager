<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;


echo GridView::widget([
    'dataProvider' => $dataProvider,

    'tableOptions' => [
        'class' => 'table table-striped',
    ],

    'layout' => "{pager}{items}",

    'showFooter' => true ,


    'columns' => [

        [
            'class' => 'yii\grid\CheckboxColumn',
            'cssClass' => 'check-box',
            'checkboxOptions' => function($model, $key, $index, $column) {
                return ['value' => $model->SCHEMA_NAME];
            },
        ],


        [
            'attribute' => 'SCHEMA_NAME',
            'contentOptions' => [
                'class' => 'db-name',
            ],
            'value' => function ($data){


                return Html::a(Html::encode($data->SCHEMA_NAME), Url::to(['schema/tables', 'schemaName' => $data->SCHEMA_NAME]));
            },
            'format' => 'raw',
            'footer' => '',
        ],

        'tableCount',
        'DEFAULT_COLLATION_NAME',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function($url, $model,$key) {
                    $url = Url::to(['schema/update' , 'schemaName' => $model->SCHEMA_NAME]);
                    return Html::a('<span class="glyphicon glyphicon-pencil update-button"></span>', $url , ['title' => 'update', 'data-toggle'=>'modal', 'data-target'=>'#myModal',]);
                },
                'delete' => function ($url, $model,$key) {
                    $url = Url::to(['schema/delete' , 'schemaName' => $model->SCHEMA_NAME]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url , ['title' => 'delete', 'data-confirm' => 'Are you sure?']);
                },
            ],

        ],
    ],




]);
?>


<?= Html::a(
    'Create New Schema',
    ['/schema/create'],
    [
        'class'=>'btn btn-primary create-button',
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
    ])
?>

<?= Html::a(
    'Delete Selected Schemas',
    ['/schema/delete'],
    [
        'class'=>'btn btn-danger delete-button',
        'onclick' => 'table.dropSchemaList();return false;',
    ])
?>





