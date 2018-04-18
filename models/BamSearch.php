<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BamSearch represents the model behind the search form of `app\models\Bam`.
 */
class BamSearch extends Bam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver_id', 'car_id', 'b_price', 'b_bruto', 'b_tarra', 'area_id'], 'integer'],
            [['b_date'], 'safe'],
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
        $query = Bam::find();

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
            'b_date' => $this->b_date,
            'b_price' => $this->b_price,
            'b_bruto' => $this->b_bruto,
            'b_tarra' => $this->b_tarra,
        ]);


        return $dataProvider;
    }
}