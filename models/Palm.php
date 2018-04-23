<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;

/**
 * This is the model class for table "palm".
 *
 * @property int $id
 * @property string $factory
 * @property int $p_price
 * @property string $p_date
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 */
class Palm extends AppModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'palm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['factory'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['p_price'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
            [['factory'], 'string', 'max' => 20],
            [['p_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'factory' => AppLabels::FACTORY,
            'p_price' => AppLabels::PRICE,
            'p_date' => AppLabels::DATE,
        ];
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if (!$this->p_date == '') {
            $this->p_date = Yii::$app->formatter->asDate($this->p_date, AppConstants::FORMAT_DB_DATE_PHP);
        }


        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if (!$this->p_date == '') {
            $this->p_date = Yii::$app->formatter->asDate($this->p_date, AppConstants::FORMAT_DATE_PHP_SHOW_MONTH);
        }
    }
}
