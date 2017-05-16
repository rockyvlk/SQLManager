<?php

namespace app\models;

use yii\db\ActiveRecord;

class CharacterSet extends ActiveRecord {

    public static function tableName() {
        return 'CHARACTER_SETS';
    }

    public static function primaryKey() {
        return ['CHARACTER_SET_NAME'];
    }

    public function getCollations() {
        return $this->hasMany(Collation::className(), [ 'CHARACTER_SET_NAME' => 'CHARACTER_SET_NAME']);
    }


}