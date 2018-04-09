<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spending".
 *
 * @property int $id
 * @property string $s_date
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property SpendingDetail[] $spendingDetails
 */
class Spending extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spending';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_date', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['s_date'], 'safe'],
            [['created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_date' => 'S Date',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpendingDetails()
    {
        return $this->hasMany(SpendingDetail::className(), ['spending_id' => 'id']);
    }
}
