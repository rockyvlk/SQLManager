<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Schema extends ActiveRecord {

    public $tableCount;


    public static function tableName() {
        return 'SCHEMATA';
    }

    public static function primaryKey() {
        return ['SCHEMA_NAME',];
    }

    public function rules() {
        return [
            [
                ['SCHEMA_NAME','DEFAULT_COLLATION_NAME'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'SCHEMA_NAME' => Yii::t('app', 'Database'),
            'DEFAULT_COLLATION_NAME' => Yii::t('app', 'Collation'),
            'tableCount' => Yii::t('app', 'Tables'),
        ];
    }

    public function getTables() {
        return $this->hasMany(Table::className(), [ 'TABLE_SCHEMA' => 'SCHEMA_NAME']);
    }

    public function getViews() {
        return $this->hasMany(View::className(), [ 'TABLE_SCHEMA' => 'SCHEMA_NAME']);
    }

    public function createSchema($name, $collation) {
        $this->getDb()->createCommand('CREATE DATABASE ' . $name . " DEFAULT COLLATE = " . $collation)->execute();
    }

    public function updateSchema($name, $collation) {
        $this->getDb()->createCommand('ALTER DATABASE ' . $name . " DEFAULT COLLATE = " . $collation)->execute();
    }

    public function deleteSchema($name) {
       $this->getDb()->createCommand('DROP DATABASE ' . $name)->execute();
    }

}