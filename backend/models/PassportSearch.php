<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Passport;

/**
 * PassportSearch represents the model behind the search form about `common\models\Passport`.
 */
class PassportSearch extends Passport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['own_lastname', 'own_firstname', 'own_fathername', 'own_maidenname', 'own_birthplace', 'own_birthdate', 'pass_seria', 'pass_num', 'pass_get', 'pass_by', 'reg_region', 'reg_city', 'reg_street', 'reg_house', 'reg_housing', 'reg_flat'], 'safe'],
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
        $query = Passport::find();

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
            'user_id' => $this->user_id,
            'own_birthdate' => $this->own_birthdate,
            'pass_get' => $this->pass_get,
        ]);

        $query->andFilterWhere(['like', 'own_lastname', $this->own_lastname])
            ->andFilterWhere(['like', 'own_firstname', $this->own_firstname])
            ->andFilterWhere(['like', 'own_fathername', $this->own_fathername])
            ->andFilterWhere(['like', 'own_maidenname', $this->own_maidenname])
            ->andFilterWhere(['like', 'own_birthplace', $this->own_birthplace])
            ->andFilterWhere(['like', 'pass_seria', $this->pass_seria])
            ->andFilterWhere(['like', 'pass_num', $this->pass_num])
            ->andFilterWhere(['like', 'pass_by', $this->pass_by])
            ->andFilterWhere(['like', 'reg_region', $this->reg_region])
            ->andFilterWhere(['like', 'reg_city', $this->reg_city])
            ->andFilterWhere(['like', 'reg_street', $this->reg_street])
            ->andFilterWhere(['like', 'reg_house', $this->reg_house])
            ->andFilterWhere(['like', 'reg_housing', $this->reg_housing])
            ->andFilterWhere(['like', 'reg_flat', $this->reg_flat]);

        return $dataProvider;
    }
}
