<?php

use yii\grid\GridView;


echo GridView::widget([
    'dataProvider' => $dataProvider,

    'tableOptions' => [
        'class' => 'table table-striped',
    ],

    'layout' => "{items}\n{pager}",

    'showFooter' => true ,



]);