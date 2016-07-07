<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_button".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $button_id
 */
class Order_button extends \yii\db\ActiveRecord
{

    /*
    statuses:
    0 - not in work
    1 - in work
    2 - success
    3 - fail
    */

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_button';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'button_id'], 'required'],
            [['order_id', 'button_id', 'status', 'payed'], 'integer'],
            [['file', 'status', 'tooltip'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'button_id' => Yii::t('app', 'Button ID'),
        ];
    }

    public function getButton() {
        return $this->hasOne(\common\models\Buttons::className(), ['id'=>'button_id']);
    }

    public function getOrder() {
        return $this->hasOne(\common\models\Order::className(), ['id'=>'order_id']);
    }

}
