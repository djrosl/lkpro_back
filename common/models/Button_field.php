<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "button_field".
 *
 * @property integer $id
 * @property integer $button_id
 * @property integer $field_id
 */
class Button_field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'button_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['button_id', 'field_id'], 'required'],
            [['button_id', 'field_id', 'required'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'button_id' => Yii::t('app', 'Button ID'),
            'field_id' => Yii::t('app', 'Field ID'),
            'required' => Yii::t('app', 'Обьязательное поле?'),
        ];
    }
}
