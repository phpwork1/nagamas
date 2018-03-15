<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $buyer_id
 * @property string $t_date
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Buyer $buyer
 * @property TransactionDetail[] $transactionDetails
 */
class Transaction extends AppModel
{
    public $buyer_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buyer_id', 't_date'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['buyer_id'], 'integer', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['t_date'], 'safe'],
            [['t_date', 'buyer_id'], 'unique', 'message' => AppConstants::VALIDATE_UNIQUE, 'targetAttribute' => ['t_date', 'buyer_id']],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buyer::className(), 'targetAttribute' => ['buyer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'buyer_id' => AppLabels::BUYER,
            't_date' => AppLabels::DATE,
            'buyer_name' => sprintf("%s %s", AppLabels::NAME, AppLabels::BUYER),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(Buyer::className(), ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetail::className(), ['transaction_id' => 'id']);
    }

    public function getTransactionDetailsByType($type){
        return TransactionDetail::find()->where(['transaction_id' => $this->id, 'td_type' => $type])->all();
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->t_date == '') {
            $this->t_date = Yii::$app->formatter->asDate($this->t_date, AppConstants::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->buyer_name = $this->buyer->b_name;

        if(!$this->t_date == '') {
            $this->t_date = Yii::$app->formatter->asDate($this->t_date, AppConstants::FORMAT_DATE_PHP_SHOW_MONTH);
        }
    }
}
