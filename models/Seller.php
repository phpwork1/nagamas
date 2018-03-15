<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;

/**
 * This is the model class for table "seller".
 *
 * @property int $id
 * @property string $s_name
 * @property string $s_address
 * @property string $s_m_number
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 */
class Seller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name'], 'required','message' => AppConstants::VALIDATE_REQUIRED],
            [['s_name'], 'string', 'max' => 100],
            [['s_address'], 'string', 'max' => 255],
            [['s_m_number'], 'string', 'max' => 20],
            [['s_m_number'], 'unique', 'message' => AppConstants::VALIDATE_UNIQUE]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_name' => AppLabels::NAME,
            's_address' => AppLabels::ADDRESS,
            's_m_number' => AppLabels::PHONE,
        ];
    }
}
