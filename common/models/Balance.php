<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "balance".
 *
 * @property integer $id
 * @property integer $summ
 * @property integer $user_id
 */
class Balance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['summ', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summ' => 'Summ',
            'user_id' => 'User ID',
        ];
    }
}
