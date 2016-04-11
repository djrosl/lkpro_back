<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type_sections".
 *
 * @property integer $id
 * @property string $title
 * @property string $info
 * @property integer $order
 * @property integer $type_id
 */
class Type_sections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_sections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type_id'], 'required'],
            [['info'], 'string'],
            [['order', 'type_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'info' => Yii::t('app', 'Info'),
            'order' => Yii::t('app', 'Order'),
            'type_id' => Yii::t('app', 'Type ID'),
        ];
    }

    public function getType() {
        return $this->hasOne(\common\models\Database_types::className(), ['id'=>'type_id']);
    }

    public function getDatabases() {
        return $this->hasMany(\common\models\Database::className(), ['section_id'=>'id']);
    }

}
