<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RamSearch represents the model behind the search form of `app\models\Ram`.
 */
class RamSearch extends Ram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver_id', 'car_id', 'r_price', 'r_bruto', 'r_tarra', 'area_id'], 'integer'],
            [['r_date'], 'safe'],
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
        $query = Ram::find();

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
            'r_date' => $this->r_date,
            'r_price' => $this->r_price,
            'r_bruto' => $this->r_bruto,
            'r_tarra' => $this->r_tarra,
        ]);


        return $dataProvider;
    }
}
