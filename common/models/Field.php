<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "field".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['type'], 'integer'],
            [['title', 'subfields'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', 'Type'),
        ];
    }

    public function getButtons() {
        return $this->hasMany(\common\models\Buttons::className(), ['id'=>'button_id'])
            ->viaTable('button_field', ['field_id'=>'id']);
    }

}
