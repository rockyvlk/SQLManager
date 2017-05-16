<?php

namespace app\models;

use yii\db\ActiveRecord;


class Row extends ActiveRecord {

    public static $schema ;
    public static $table;
    public static $db;



    public static function tableName() {
        return self::$table;
    }

    public static function getDb() {
        return self::$db;
    }

    public static function primaryKey() {
        return self::$db->getSchema(self::$schema)->getTableSchema(self::$table)->primaryKey;
    }


    public function attributeLabels() {
         return self::$db->getSchema(self::$schema)->getTableSchema(self::$table)->getColumnNames();
    }

}