<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;


echo GridView::widget([
    'dataProvider' => $dataProvider,

    'tableOptions' => [
        'class' => 'table table-striped',
    ],

    'layout' => "{items}\n{pager}",

    'showFooter' => true ,


    'columns' => [

        [
            'class' => 'yii\grid\CheckboxColumn',
            'cssClass' => 'check-box',
        ],



        [
            'attribute' => 'TABLE_NAME',
            'contentOptions' => [
                'class' => 'table-name',
            ],
            'value' => function ($data) {
                return Html::a(Html::encode($data->TABLE_NAME), Url::to(['view/browse', 'schemaName' => $data->TABLE_SCHEMA , 'tableName' => $data->TABLE_NAME]));
            },
            'format' => 'raw',
        ],

        [
            'class' => 'yii\grid\ActionColumn',
        ],


        [
            'attribute' => 'IS_UPDATABLE',
        ],

    ]

]);