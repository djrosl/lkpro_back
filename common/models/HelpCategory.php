<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "help_category".
 *
 * @property integer $id
 * @property string $title
 */
class HelpCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'help_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getHelp() {
        return $this->hasMany(\common\models\Help::className(), ['category_id'=>'id']);
    }

}
