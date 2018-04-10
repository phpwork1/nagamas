<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "purchase_detail".
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $seller_id
 * @property string $pd_name
 * @property int $pd_rubber_weight
 * @property int $pd_rubber_price
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Purchase $purchase
 */
class PurchaseDetail extends AppModel
{
    public $seller_name;
    public $total;
    public $seller;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pd_name', 'pd_rubber_weight', 'pd_rubber_price'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['purchase_id', 'pd_rubber_weight', 'pd_rubber_price'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
            [['pd_name'], 'string', 'max' => 20],
            [['purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Purchase::className(), 'targetAttribute' => ['purchase_id' => 'id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purchase_id' => AppLabels::PURCHASE,
            'pd_name' => AppLabels::GROUP,
            'pd_rubber_weight' => AppLabels::WEIGHT,
            'seller_name' => sprintf("%s %s", AppLabels::NAME, AppLabels::SELLER),
            'pd_rubber_price' => AppLabels::PRICE,

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchase()
    {
        return $this->hasOne(Purchase::className(), ['id' => 'purchase_id']);
    }



    public function saveTransactional() {

        $request = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        $errors = [];

        try {
            $this->load($request);

            $todayPurchase = Purchase::find()->where(['p_date' => Yii::$app->formatter->asDate(time(), AppConstants::FORMAT_DB_DATE_PHP), 'seller_id' => $request['PurchaseDetail']['seller']])->one();
            if(!isset($todayPurchase) || isset($request['note'])){
                $model = new Purchase();
                $model->p_date = Yii::$app->formatter->asDate(time(), AppConstants::FORMAT_DB_DATE_PHP);
                $model->seller_id = $request['PurchaseDetail']['seller'];
                $model->p_stamp = 1;
                $model->p_commission = '1';
                $model->p_other = $request['other'];
                if(isset($request['transfer'])){
                    $model->p_transfer = 1;
                }
                if (!$model->save()) {
                    $errors = array_merge($errors, $this->errors);
                    throw new Exception();
                }
                $purchaseId = $model->id;
            }else{
                $purchaseId = $todayPurchase->id;
                if(!isset($todayPurchase->p_other)){
                    if(isset($request['other'])){
                        $todayPurchase->p_other = $request['other'];
                        if (!$todayPurchase->save()) {
                            $errors = array_merge($errors, $this->errors);
                            throw new Exception();
                        }
                    }
                }
            }

            $purchaseDetailTuple = new PurchaseDetail();
            $purchaseDetailTuple->load(['PurchaseDetail' => $request['PurchaseDetail']]);
            $purchaseDetailTuple->purchase_id = $purchaseId;

            if (!$purchaseDetailTuple->save()) {
                $errors = array_merge($errors, $purchaseDetailTuple->errors);
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
        $this->total = $this->pd_rubber_weight*$this->pd_rubber_price;
    }
}
