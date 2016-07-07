<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_payment".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $summ
 * @property string $date
 * @property integer $user_id
 */
class OrderPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'summ', 'user_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'summ' => 'Summ',
            'date' => 'Date',
            'user_id' => 'User ID',
        ];
    }
}
