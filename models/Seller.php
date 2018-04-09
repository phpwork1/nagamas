<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;
use yii\helpers\ArrayHelper;

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
 *
 * @property Purchase[] $purchases
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
     * Return model objects
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return \yii\db\ActiveRecord[]
     */
    public static function getAll($value = 'b_name', $conditions = null) {
        $query = Seller::find()->orderBy([$value => SORT_ASC]);
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }
        return $query->all();
    }

    /**
     * Return array of key => value for dropdown menu
     * @param string $key default to 'id'
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return array
     */
    public static function map($key = 'id', $value = 's_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);

        return $map;
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['seller_id' => 'id'])->orderBy(['p_date' => SORT_DESC]);
    }
}
