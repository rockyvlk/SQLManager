<?php

namespace app\components\SqlRequest;

use yii\base\Widget;

class SqlRequestWidget extends Widget{

    public function init() {
        parent::init();
    }

    public function run() {



        return $this->render('sql');
    }

}