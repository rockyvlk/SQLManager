<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class View extends ActiveRecord {

    public static function tableName() {
        return 'VIEWS';
    }


    public static function primaryKey() {
        return ['TABLE_NAME'];
    }

    public function rules() {
        return ['TABLE_NAME', 'string'];
    }

    public function attributeLabels() {
        return [
            'TABLE_NAME' => Yii::t('app', 'View'),
            'IS_UPDATABLE' => Yii::t('app', 'Updatable'),
        ];
    }

    public function getSchema() {
        return $this->hasOne(Schema::className(), [  'SCHEMA_NAME' => 'TABLE_SCHEMA' ]);
    }

}