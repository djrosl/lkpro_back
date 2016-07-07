<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "buttons".
 *
 * @property integer $id
 * @property string $title
 * @property integer $price
 * @property string $help
 * @property string $example
 * @property string $time
 * @property integer $status
 */
class Buttons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buttons';
    }


    public function behaviors(){
        return [
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'fields' => 'fields',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price', 'db_id'], 'required'],
            [['price', 'status', 'db_id'], 'integer'],
            [['help', 'example', 'time'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['fields'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'help' => Yii::t('app', 'Help'),
            'example' => Yii::t('app', 'Example'),
            'time' => Yii::t('app', 'Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getDatabase() {
        $this->hasOne(\common\models\Database::className(), ['id'=>'db_id']);
    }

    public function getFields() {
        return $this->hasMany(\common\models\Field::className(), ['id'=>'field_id'])
            ->viaTable('button_field', ['button_id'=>'id']);
    }

    public function getOrderCount() {
        return $this->hasMany(\common\models\Order::className(), ['id'=>'order_id'])
            ->viaTable('order_button', ['button_id'=>'id'])->count();
    }

    public function getBfields() {
        return $this->hasMany(\common\models\Button_field::className(), ['button_id'=>'id']);
    }

}
