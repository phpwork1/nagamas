<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PurchaseDetail;

/**
 * PurchaseDetailSearch represents the model behind the search form of `app\models\PurchaseDetail`.
 */
class PurchaseDetailSearch extends PurchaseDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pd_name', 'id', 'purchase_id', 'pd_rubber_weight', 'pd_rubber_price', 'pd_commission', 'pd_stamp', 'pd_other'], 'integer'],
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
        $query = PurchaseDetail::find();

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
            'purchase_id' => $this->purchase_id,
            'pd_rubber_weight' => $this->pd_rubber_weight,
            'pd_rubber_price' => $this->pd_rubber_price,
            'pd_commission' => $this->pd_commission,
            'pd_stamp' => $this->pd_stamp,
            'pd_other' => $this->pd_stamp,
        ]);

        $query->andFilterWhere(['like', 'pd_name', $this->pd_name]);

        return $dataProvider;
    }
}
