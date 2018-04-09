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
 * @property int $pd_commission
 * @property int $pd_stamp
 * @property int $pd_other
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
    public $total_dirty;
    public $total_clean;
    public $commission;
    public $stamp;
    public $seller;
    public $labor;
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
            [['pd_name', 'pd_rubber_weight', 'pd_rubber_price', 'pd_commission', 'pd_stamp'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['pd_other', 'purchase_id', 'pd_rubber_weight', 'pd_rubber_price', 'pd_stamp'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
            [['pd_name'], 'string', 'max' => 20],
            [['pd_commission'], 'string', 'max' => 20],
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
            'pd_rubber_price' => AppLabels::PRICE,
            'pd_commission' => AppLabels::COMMISSION,
            'pd_stamp' => AppLabels::STAMP,
            'pd_other' => AppLabels::OTHER,
            'total_dirty' => sprintf("%s %s", AppLabels::VALUE, AppLabels::DIRTY),
            'total_clean' => sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN),
            'labor' => AppLabels::LABOR,
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
        $this->seller_name = $this->purchase->seller->s_name;

        $this->total_dirty = $this->pd_rubber_weight*$this->pd_rubber_price;
        $this->commission = $this->total_dirty*$this->pd_commission/100;
        $this->stamp = $this->pd_stamp*6000;
        $this->labor = $this->pd_rubber_weight*AppConstants::LABOR_CONSTANT;
        $this->total_clean = $this->total_dirty-$this->commission-$this->stamp-$this->labor-$this->pd_other;
    }
}
