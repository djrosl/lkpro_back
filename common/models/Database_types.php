<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "database_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $show_title
 * @property string $icon_class
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Database_types extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'database_types';
    }

    public function behaviors() {
        return [
            "timestamp" => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'show_title'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'show_title', 'icon_class', 'slug'], 'string', 'max' => 255],
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
            'show_title' => Yii::t('app', 'Show Title'),
            'icon_class' => Yii::t('app', 'Icon Class'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getSections(){
        return $this->hasMany(\common\models\Type_sections::className(), ['type_id'=>'id']);
    }

}
