<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PalSearch represents the model behind the search form of `app\models\Pal`.
 */
class PalSearch extends Pal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver_id', 'car_id', 'p_price', 'p_bruto', 'p_tarra', 'area_id'], 'integer'],
            [['p_date'], 'safe'],
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
        $query = Pal::find();

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
            'driver_id' => $this->driver_id,
            'car_id' => $this->car_id,
            'area_id' => $this->area_id,
            'p_price' => $this->p_price,
            'p_date' => $this->p_date,
            'p_bruto' => $this->p_bruto,
            'p_tarra' => $this->p_tarra,
        ]);


        return $dataProvider;
    }
}
