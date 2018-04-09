<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spending_detail".
 *
 * @property int $id
 * @property int $spending_id
 * @property string $sd_name
 * @property int $sd_spend_value
 * @property int $sd_labor
 * @property int $sd_other
 * @property string $sd_ref
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Spending $spending
 */
class SpendingDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spending_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spending_id', 'sd_name', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['spending_id', 'sd_spend_value', 'sd_labor', 'sd_other', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['sd_name'], 'string', 'max' => 20],
            [['sd_ref'], 'string', 'max' => 255],
            [['spending_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spending::className(), 'targetAttribute' => ['spending_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'spending_id' => 'Spending ID',
            'sd_name' => 'Sd Name',
            'sd_spend_value' => 'Sd Spend Value',
            'sd_labor' => 'Sd Labor',
            'sd_other' => 'Sd Other',
            'sd_ref' => 'Sd Ref',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpending()
    {
        return $this->hasOne(Spending::className(), ['id' => 'spending_id']);
    }
}
