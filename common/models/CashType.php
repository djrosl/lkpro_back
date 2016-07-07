<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cash_type".
 *
 * @property integer $id
 * @property string $icon
 * @property string $title
 * @property string $number
 */
class CashType extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cash_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icon', 'title', 'number'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon' => 'Icon',
            'title' => 'Title',
            'number' => 'Number',
        ];
    }
}
