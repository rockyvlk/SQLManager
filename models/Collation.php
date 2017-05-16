<?php

namespace app\models;

use yii\db\ActiveRecord;

class Collation extends ActiveRecord {

    const DEFAULT_CHARACTER_SET = 'utf8';
    const DEFAULT_COLLATION = 'utf8_general_ci';
    public $collationGroup;

    public static function tableName() {
        return 'COLLATIONS';
    }

    public static function primaryKey() {
        return ['COLLATION_NAME'];
    }

    public function getCharacterSet() {
        return $this->hasOne(CharacterSet::className(), [ 'CHARACTER_SET_NAME' => 'CHARACTER_SET_NAME']);
    }

    public static function getAllCollations() {

        return self::find()
            ->select(['COLLATION_NAME', 'CHARACTER_SET_NAME'])
            ->orderBy('CHARACTER_SET_NAME')
            ->asArray()
            ->all();
    }
}