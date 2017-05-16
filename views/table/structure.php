<?php

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
            'attribute' => 'COLUMN_NAME',
            'value' => function($data){
                    return $data->COLUMN_NAME;

            }
        ],

        'COLUMN_TYPE',
        'COLLATION_NAME',
        'IS_NULLABLE',

        [
            'attribute' => 'COLUMN_DEFAULT',
            'value' => function($data){
                if($data->IS_NULLABLE == 'YES' && $data->COLUMN_DEFAULT == 0) {
                    return 'NULL';
                }
                return $data->COLUMN_DEFAULT;
            },
        ],
        'EXTRA',



        [
            'class' => 'yii\grid\ActionColumn',
        ],

    ]

]);




echo GridView::widget([
    'dataProvider' => $dataProviderIndex,

    'tableOptions' => [
        'class' => 'table table-striped',
    ],

    'layout' => "{items}\n{pager}",

    'showFooter' => true ,


    'columns' => [

        'INDEX_NAME',
        [
            'attribute' => 'type',
            'value' => function($data){
                return $data->getType();
            },
        ],
        'COLUMN_NAME',

        [
            'class' => 'yii\grid\ActionColumn',
        ],

    ]

]);