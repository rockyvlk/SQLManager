<?php

namespace app\models;

use yii\db\ActiveRecord;

class Constraint extends ActiveRecord {


    public static function tableName() {
        return 'KEY_COLUMN_USAGE';
    }

    public static function primaryKey() {
        return [
            'TABLE_SCHEMA',
            'TABLE_NAME',
            'COLUMN_NAME',
            'CONSTRAINT_NAME',
        ];
    }

    public function rules() {
        return [];
    }

    public function attributeLabels() {
        return [];
    }

    public function getColumn() {
        return $this->hasOne(Column::className(), [
            'TABLE_SCHEMA' => 'TABLE_SCHEMA',
            'TABLE_NAME' => 'TABLE_NAME',
            'COLUMN_NAME' => 'COLUMN_NAME'
        ]);
    }


}