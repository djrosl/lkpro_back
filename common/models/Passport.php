<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "passport".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $own_lastname
 * @property string $own_firstname
 * @property string $own_fathername
 * @property string $own_maidenname
 * @property string $own_birthplace
 * @property string $own_birthdate
 * @property string $pass_seria
 * @property string $pass_num
 * @property string $pass_get
 * @property string $pass_by
 * @property string $reg_region
 * @property string $reg_city
 * @property string $reg_street
 * @property string $reg_house
 * @property string $reg_housing
 * @property string $reg_flat
 */
class Passport extends \yii\db\ActiveRecord
{

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public $images;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'own_lastname', 'own_firstname', 'own_fathername', 'own_birthplace', 'own_birthdate', 'pass_seria', 'pass_num', 'pass_get', 'pass_by', 'reg_region', 'reg_city', 'reg_street', 'reg_house', 'reg_flat'], 'required'],
            [['user_id'], 'integer'],
            [['own_birthdate', 'pass_get'], 'safe'],
            [['own_lastname', 'own_firstname', 'own_fathername', 'own_maidenname', 'own_birthplace', 'pass_seria', 'pass_num', 'pass_by', 'reg_region', 'reg_city', 'reg_street', 'reg_house', 'reg_housing', 'reg_flat'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'own_lastname' => Yii::t('app', 'Фамилия'),
            'own_firstname' => Yii::t('app', 'Имя'),
            'own_fathername' => Yii::t('app', 'Отчество'),
            'own_maidenname' => Yii::t('app', 'Девичья фамилия'),
            'own_birthplace' => Yii::t('app', 'Место рождения'),
            'own_birthdate' => Yii::t('app', 'Дата рождения'),
            'pass_seria' => Yii::t('app', 'Серия паспорта'),
            'pass_num' => Yii::t('app', 'Номер паспорта'),
            'pass_get' => Yii::t('app', 'Кем выдан'),
            'pass_by' => Yii::t('app', 'Дата выдачи'),
            'reg_region' => Yii::t('app', 'Регион'),
            'reg_city' => Yii::t('app', 'Город'),
            'reg_street' => Yii::t('app', 'Улица'),
            'reg_house' => Yii::t('app', 'Дом'),
            'reg_housing' => Yii::t('app', 'Корпус'),
            'reg_flat' => Yii::t('app', 'Квартира'),
        ];
    }
}
