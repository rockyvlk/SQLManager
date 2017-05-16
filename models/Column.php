<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Column extends ActiveRecord {

    public $constraint;

    public static function tableName() {
        return 'COLUMNS';
    }

    public static function primaryKey() {
        return ['COLUMN_NAME'];
    }

    public function rules() {
        return [
            [
                ['COLUMN_NAME','COLLATION_NAME'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'COLUMN_NAME' => Yii::t('app', 'Field'),
            'COLUMN_TYPE' => Yii::t('app', 'Type'),
            'COLLATION_NAME' => Yii::t('app', 'Collation'),
            'IS_NULLABLE' => Yii::t('app', 'Null'),
            'COLUMN_DEFAULT' => Yii::t('app', 'Default'),
            'EXTRA' => Yii::t('app', 'Extra'),
        ];
    }

    public function getTable() {
        return $this->hasOne(Table::className(), [
            'TABLE_SCHEMA' => 'TABLE_SCHEMA',
            'TABLE_NAME' => 'TABLE_NAME'
        ]);
    }

    public function getIndexes() {
        return $this->hasMany(Index::className(), [
            'TABLE_SCHEMA' => 'TABLE_SCHEMA',
            'TABLE_NAME' => 'TABLE_NAME',
            'COLUMN_NAME' => 'COLUMN_NAME'
        ]);
    }

    public function getConstraint() {
        return $this->hasOne(Constraint::className(), [
            'TABLE_SCHEMA' => 'TABLE_SCHEMA',
            'TABLE_NAME' => 'TABLE_NAME',
            'COLUMN_NAME' => 'COLUMN_NAME'
        ]);
    }


}