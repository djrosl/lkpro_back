<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $base_type
 * @property integer $status:
    1: Not payed
    2: In work
    3: Done
    4: Archive
    0: Canceled
 * @property string $cost
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'base_type'], 'required'],
            [['date'], 'safe'],
            [['user_id', 'base_type', 'status'], 'integer'],
            [['cost', 'title'], 'string', 'max' => 255],
        ];
    }

    public function behaviors() {
        return [
            "timestamp" => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
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
            'base_type' => Yii::t('app', 'Base Type'),
            'status' => Yii::t('app', 'Status'),
            'cost' => Yii::t('app', 'Cost'),
        ];
    }


    public function getFields(){
        return $this->hasMany(\common\models\Order_field::className(), ['order_id'=>'id']);
    }

    public function getButtons(){
        return $this->hasMany(\common\models\Buttons::className(), ['id'=>'button_id'])
            ->viaTable('order_button', ['order_id'=>'id']);
    }

    public function getOrderbuttons(){
        return $this->hasMany(\common\models\Order_button::className(), ['order_id'=>'id']);
    }

    public function getUser() {
        return $this->hasOne(\common\models\User::className(), ['id'=>'user_id']);
    }

    public function stringStatus() {
        switch ($this->status) {
            case 1:
                return 'Не оплачено';
            case 2:
                return 'В работе';
            case 3:
                return 'Выполнено';
            case 4:
                return 'В архиве';
            default:
                return 'Отменено';
        }
    }

    public function getBasetype() {
        return $this->hasOne(\common\models\Database_types::className(), ['id'=>'base_type']);
    }


}
