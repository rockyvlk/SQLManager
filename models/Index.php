<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Index extends ActiveRecord {


    public static function tableName() {
        return 'STATISTICS';
    }

    public static function primaryKey() {
        return [
            'TABLE_SCHEMA',
            'TABLE_NAME',
            'INDEX_NAME',
            'COLUMN_NAME',
        ];
    }

    public function rules() {
        return [
            [
                ['INDEX_NAME','COLUMN_NAME'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'INDEX_NAME' => Yii::t('app', 'Index'),
            'type' => Yii::t('app', 'Type'),
            'COLUMN_NAME' => Yii::t('app', 'Field'),
        ];
    }

    public function getColumns() {
        return $this->hasMany(Column::className(), [
            'TABLE_SCHEMA' => 'TABLE_SCHEMA',
            'TABLE_NAME' => 'TABLE_NAME',
            'COLUMN_NAME' => 'COLUMN_NAME'
        ]);
    }


    public function getType() {

        if($this->INDEX_NAME == 'PRIMARY') {
            return 'PRIMARY';
        } elseif($this->INDEX_TYPE == 'FULLTEXT') {
            return 'FULLTEXT';
        } elseif($this->NON_UNIQUE == 0) {
            return 'UNIQUE';
        } else {
            return 'INDEX';
        }

    }

}