<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "database".
 *
 * @property integer $id
 * @property string $content
 * @property string $image
 * @property integer $type_id
 * @property integer $section_id
 * @property integer $column_width
 * @property integer $type
 * @property string $important
 */
class Database extends \yii\db\ActiveRecord
{

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'database';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'type_id', 'section_id'], 'required'],
            [['content', 'important', 'title'], 'string'],
            [['type_id', 'section_id', 'column_width', 'type'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'type_id' => Yii::t('app', 'Type ID'),
            'section_id' => Yii::t('app', 'Section ID'),
            'column_width' => Yii::t('app', 'Column Width'),
            'type' => Yii::t('app', 'Type'),
            'important' => Yii::t('app', 'Important'),
        ];
    }

    public function fields() {
        $fields = parent::fields();

        return yii\helpers\ArrayHelper::merge($fields,[
            'image'=>function($model){
                if(!is_null($model->getImage()))
                    return 'http://admin.lkpro.loc'.$model->getImage()->getUrl();
            }
        ]);
    }

    public function getButtons() {
        return $this->hasMany(\common\models\Buttons::className(), ['db_id'=>'id']);
    }
}
