<?php

use app\components\SqlRequest\SqlRequestWidget;
use yii\grid\GridView;

echo SqlRequestWidget::widget();



if(isset($sqlDataProvider)) {
    echo GridView::widget([
        'dataProvider' => $sqlDataProvider,

        'tableOptions' => [
            'class' => 'table table-striped',
        ],

        'layout' => "{items}\n{pager}",

        'showFooter' => true ,

    ]);
}
?>
