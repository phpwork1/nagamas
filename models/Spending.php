<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
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
class Spending extends AppModel
{
    public $total;
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
            [['s_date'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['s_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_date' => AppLabels::DATE,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpendingDetails()
    {
        return $this->hasMany(SpendingDetail::className(), ['spending_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if (!$this->s_date == '') {
            $this->s_date = Yii::$app->formatter->asDate($this->s_date, AppConstants::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->total = $this->getTotalSpending();

        if (!$this->s_date == '') {
            $this->s_date = Yii::$app->formatter->asDate($this->s_date, AppConstants::FORMAT_DATE_PHP_SHOW_MONTH);
        }
    }

    public function getTotalSpending(){
        $total = 0;
        foreach($this->spendingDetails as $key => $spending){
            $total += $spending->total;
        }
        return $total;
    }

    public static function getSpendingByMonthYear($month, $year){
        return Spending::findBySql("SELECT * FROM spending where EXTRACT(MONTH FROM s_date) = $month AND EXTRACT(YEAR FROM s_date) = $year ORDER BY s_date ASC")->all();
    }
}
