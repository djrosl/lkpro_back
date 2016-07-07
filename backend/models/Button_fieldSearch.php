<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Button_field;

/**
 * Button_fieldSearch represents the model behind the search form about `common\models\Button_field`.
 */
class Button_fieldSearch extends Button_field
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'button_id', 'field_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Button_field::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'button_id' => $this->button_id,
            'field_id' => $this->field_id,
        ]);

        return $dataProvider;
    }
}
