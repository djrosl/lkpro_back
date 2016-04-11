<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "header".
 *
 * @property integer $id
 * @property string $column_1
 * @property string $column_2
 * @property string $column_3
 */
class Header extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['column_1', 'column_2', 'column_3'], 'required'],
            [['column_1', 'column_2', 'column_3'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'column_1' => Yii::t('app', 'Column 1'),
            'column_2' => Yii::t('app', 'Column 2'),
            'column_3' => Yii::t('app', 'Column 3'),
        ];
    }
}
