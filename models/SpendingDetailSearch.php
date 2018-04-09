<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SpendingDetail;

/**
 * SpendingDetailSearch represents the model behind the search form of `app\models\SpendingDetail`.
 */
class SpendingDetailSearch extends SpendingDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'spending_id', 'sd_spend_value', 'sd_labor', 'sd_other', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['sd_name', 'sd_ref'], 'safe'],
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
        $query = SpendingDetail::find();

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
            'spending_id' => $this->spending_id,
            'sd_spend_value' => $this->sd_spend_value,
            'sd_labor' => $this->sd_labor,
            'sd_other' => $this->sd_other,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sd_name', $this->sd_name])
            ->andFilterWhere(['like', 'sd_ref', $this->sd_ref]);

        return $dataProvider;
    }
}
