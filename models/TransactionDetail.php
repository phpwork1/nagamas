<?php

namespace app\models;

use Yii;
use app\components\base\AppConstants;
use app\components\base\AppLabels;
use yii\base\Exception;

/**
 * This is the model class for table "transaction_detail".
 *
 * @property int $id
 * @property int $transaction_id
 * @property string $td_name
 * @property int $td_type
 * @property int $td_rubber_weight
 * @property int $td_rubber_price
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Transaction $transaction
 */
class TransactionDetail extends AppModel
{
    public $total;
    public $buyer;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['td_name', 'td_rubber_weight', 'td_rubber_price', 'td_type'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['transaction_id', 'td_rubber_weight', 'td_rubber_price', 'td_type'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
            [['td_name'], 'string', 'max' => 20],
            [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['transaction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_id' => AppLabels::TRANSACTION,
            'td_name' => AppLabels::GROUP,
            'td_type' => AppLabels::TYPE,
            'td_rubber_weight' => AppLabels::WEIGHT,
            'td_rubber_price' => AppLabels::PRICE,
            'total' => AppLabels::TOTAL,
            'buyer' => AppLabels::BUYER,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'transaction_id']);
    }

    public function saveTransactional() {

        $request = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        $errors = [];

        try {
            $this->load($request);

            $todayTransaction = Transaction::find()->where(['t_date' => Yii::$app->formatter->asDate(time(), AppConstants::FORMAT_DB_DATE_PHP), 'buyer_id' => $request['TransactionDetail']['buyer']])->one();
            if(!isset($todayTransaction)){
                $model = new Transaction();
                $model->t_date = Yii::$app->formatter->asDate(time(), AppConstants::FORMAT_DB_DATE_PHP);
                $model->buyer_id = $request['TransactionDetail']['buyer'];
                if (!$model->save()) {
                    $errors = array_merge($errors, $this->errors);
                    throw new Exception();
                }
                $transactionId = $model->id;
            }else{
                $transactionId = $todayTransaction->id;
            }

            $transactionDetailTuple = new TransactionDetail();
            $transactionDetailTuple->load(['TransactionDetail' => $request['TransactionDetail']]);
            $transactionDetailTuple->transaction_id = $transactionId;

            if (!$transactionDetailTuple->save()) {
                $errors = array_merge($errors, $transactionDetailTuple->errors);
                throw new Exception();
            }

            $transaction->commit();
            return TRUE;
        } catch (Exception $ex) {
            $transaction->rollBack();

            foreach ($errors as $attr => $errorArr) {
                $error = join('<br />', $errorArr);
                Yii::$app->session->addFlash('danger', $error);
            }

            return FALSE;
        }
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->total = $this->td_rubber_weight*$this->td_rubber_price;
    }
}
