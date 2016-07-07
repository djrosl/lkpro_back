<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_field".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $field_id
 * @property string $content
 */
class Order_field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'field_id'], 'required'],
            [['order_id', 'field_id'], 'integer'],
            [['content'], 'string'],
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
            'field_id' => Yii::t('app', 'Field ID'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

    public function getField(){
        return $this->hasOne(\common\models\Field::className(), ['id'=>'field_id']);
    }
}
