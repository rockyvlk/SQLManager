<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Table extends ActiveRecord  {

    public $dataLength;
    public static $db;


    public function __construct($dbConnecnion = '') {
        self::$db = $dbConnecnion;
    }


    public static function tableName() {
        return 'TABLES';
    }

    public static function primaryKey() {
        return ['TABLE_NAME'];
    }

    public static function getDb() {
        if(self::$db) {
            return self::$db;
        } else {
            return Yii::$app->db;
        }
    }

    public function rules() {
        return [
            [
                ['TABLE_NAME','TABLE_COLLATION','ENGINE'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'TABLE_NAME' => Yii::t('app', 'Table'),
            'TABLE_ROWS' => Yii::t('app', 'Rows'),
            'ENGINE' => Yii::t('app', 'Engine'),
            'TABLE_COLLATION' => Yii::t('app', 'Collation'),
            'dataLength' => Yii::t('app', 'Size'),
            'DATA_FREE' => Yii::t('app', 'Overhead'),
        ];
    }

    public function getSchema() {
        return $this->hasOne(Schema::className(), [
            'SCHEMA_NAME' => 'TABLE_SCHEMA'
        ]);
    }

    public function getColumns() {
        return $this->hasMany(Column::className(), [
            'TABLE_SCHEMA' => 'TABLE_SCHEMA',
            'TABLE_NAME' => 'TABLE_NAME'
        ]);
    }

    public function truncateTable($tableName) {
        $this->getDB()->createCommand('TRUNCATE TABLE '.  $tableName)->execute();
    }

    public function deleteTable($name) {
        $this->getDb()->createCommand('DROP TABLE ' . $name)->execute();
    }
}