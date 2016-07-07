<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property integer $summ
 * @property integer $user_id
 * @property integer $status
 * @property string $date
 * @property integer $type
 * @property string $check
 * @property integer $cash_type
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['summ', 'user_id', 'status', 'type', 'cash_type'], 'integer'],
            [['date'], 'safe'],
            [['check', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summ' => 'Сумма',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'date' => 'Дата',
            'type' => 'Тип',
            'check' => 'Файл чека',
            'cash_type' => 'Тип денег',
            'comment' => 'Комментарий',
        ];
    }

    public function getUser() {
        return $this->hasOne(\common\models\User::className(), ['id'=>'user_id']);
    }

    public function typeString() {
        return $this->type === 0 ? 'Авто' : 'Вручную';
    }

    public function cashTypeString() {
        return $this->cash_type === 0 ? 'Яндекс.Деньги' : 'QIWI';   
    }

    public function statusString() {
        return $this->status === 0 ? 'Ожидает' : 'Проведен';   
    }

    public function getCashType() {
        return $this->hasOne(\common\models\CashType::className(), ['id'=>'cash_type']);
    }

}
