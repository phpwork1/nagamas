<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;

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
class SpendingDetail extends AppModel
{
    public $total;
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
            [['spending_id', 'sd_name'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['spending_id', 'sd_spend_value', 'sd_labor', 'sd_other'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
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
            'spending_id' => AppLabels::SPENDING,
            'sd_name' => AppLabels::NAME,
            'sd_spend_value' => AppLabels::PURCHASE,
            'sd_labor' => AppLabels::LABOR,
            'sd_other' => AppLabels::OTHER,
            'sd_ref' => AppLabels::DESCRIPTION,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpending()
    {
        return $this->hasOne(Spending::className(), ['id' => 'spending_id']);
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->total = $this->sd_spend_value + $this->sd_labor + $this->sd_other;
    }
}
