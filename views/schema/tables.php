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
                return ['value' => $model->TABLE_NAME];
            },
        ],



        [
            'attribute' => 'TABLE_NAME',
            'contentOptions' => [
                'class' => 'table-name',
            ],
            'value' => function ($data) {
                return Html::a(Html::encode($data->TABLE_NAME), Url::to(['table/browse', 'schemaName' => $data->TABLE_SCHEMA , 'tableName' => $data->TABLE_NAME]));
            },
            'format' => 'raw',
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{browse} {structure} {truncate} {delete}',
            'buttons' => [
                'browse' => function($url, $model,$key) {
                    $url = Url::to(['table/browse' , 'schemaName' => $model->TABLE_SCHEMA , 'tableName' => $model->TABLE_NAME]);
                    return Html::a('<span class="glyphicon glyphicon-eye-open browse-button"></span>', $url , ['title' => 'Browse']);
                },
                 'structure' => function($url, $model,$key) {
                    $url = Url::to(['table/structure' , 'schemaName' => $model->TABLE_SCHEMA , 'tableName' => $model->TABLE_NAME]);
                    return Html::a('<span class="glyphicon glyphicon-list"></span>', $url , ['title' => 'Structure']);
                },
                'truncate' => function($url, $model,$key) {
                    $url = Url::to(['table/truncate' , 'schemaName' => $model->TABLE_SCHEMA ,'tableName' => $model->TABLE_NAME]);
                    return Html::a('<span class="glyphicon glyphicon-erase"></span>', $url , ['title' => 'Empty']);
                },
                'delete' => function ($url, $model,$key) {
                    $url = Url::to(['table/delete' , 'schemaName' => $model->TABLE_SCHEMA, 'tableName' => $model->TABLE_NAME]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url , ['title' => 'Delete', 'data-confirm' => 'Are you sure?']);
                },

            ]
        ],


        [
            'attribute' => 'TABLE_ROWS',
            'format' => 'integer',
        ],

        'ENGINE',
        'TABLE_COLLATION',

        [
            'attribute' => 'dataLength',
            'format' => 'shortSize',
        ],


        [
            'attribute' => 'DATA_FREE',
            'format' => 'shortSize',
        ],
    ]

]);

echo Html::a(
    'Create New Table',
    ['/table/create'],
    [
        'class'=>'btn btn-primary create-button',
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
    ]);


echo Html::a(
    'Delete Selected Tables',
    ['/table/delete'],
    [
        'class'=>'btn btn-danger delete-button',
        'onclick' => 'table.dropTableList();return false;',
    ]);