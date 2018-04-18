<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PalmSearch represents the model behind the search form of `app\models\Palm`.
 */
class PalmSearch extends Palm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'p_price', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['factory', 'p_date'], 'safe'],
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
        $query = Palm::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'p_date' => SORT_DESC,
                ],
            ],
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
            'p_price' => $this->p_price,
            'p_date' => $this->p_date,
        ]);

        $query->andFilterWhere(['like', 'factory', $this->factory]);

        return $dataProvider;
    }
}
