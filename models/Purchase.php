<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property int $id
 * @property string $p_date
 * @property int $seller_id
 * @property int $p_fresh
 * @property int $p_transfer
 * @property int $p_commission
 * @property int $p_stamp
 * @property int $p_other
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property PurchaseDetail[] $purchaseDetails
 * @property Seller $seller
 */
class Purchase extends AppModel
{
    public $total_dirty;
    public $total_clean;
    public $commission;
    public $stamp;
    public $labor;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_id', 'p_date', 'p_commission', 'p_stamp'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['p_stamp', 'p_fresh', 'p_transfer', 'p_other'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
            [['p_date'], 'safe'],
            [['p_commission'], 'string', 'max' => 20],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seller::className(), 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_date' => AppLabels::DATE,
            'seller_id' => sprintf("%s %s", AppLabels::NAME, AppLabels::SELLER),
            'seller_name' => AppLabels::SELLER,
            'total_clean' => sprintf("%s %s", AppLabels::VALUE, AppLabels::CLEAN),
            'total_dirty' => sprintf("%s %s", AppLabels::VALUE, AppLabels::DIRTY),
            'p_commission' => AppLabels::COMMISSION,
            'p_stamp' => AppLabels::STAMP,
            'p_other' => AppLabels::OTHER,
            'labor' => AppLabels::LABOR,
			'p_fresh' => 'Pengeluaran?',
			'p_transfer' => 'Metode Pembayaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::className(), ['purchase_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Seller::className(), ['id' => 'seller_id']);
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

        $this->total_dirty = $this->getTotal();
        $this->commission = $this->total_dirty*$this->p_commission/100;
        $this->stamp = $this->p_stamp*AppConstants::DEFAULT_STAMP_PRICE;
        $this->labor = $this->getTotalWeight()*AppConstants::LABOR_CONSTANT;
        $this->total_clean = $this->total_dirty-$this->commission-$this->stamp-$this->labor-$this->p_other;


    }

    public function updateTotal(){
        $this->total = $this->getTotal();
    }

    public static function getPurchasesByDate($date){
        return Purchase::find()->where(['p_date' => $date])->all();
    }

    public static function getTotalToday(){
        $total = 0;
        $purchases = self::getPurchasesByDate(Yii::$app->formatter->asDate(time(), AppConstants::FORMAT_DB_DATE_PHP));
        foreach($purchases as $key1 => $purchase){
            foreach($purchase->purchaseDetails as $key2 => $detail){
                $total += $detail->pd_rubber_weight;
            }
        }
        return $total;
    }

    public static function getTotalWeightByMonthYear($month, $year){
        $totalWeight = 0;
        $allPurchase = Purchase::findBySql("SELECT * FROM purchase where EXTRACT(MONTH FROM p_date) = $month AND EXTRACT(YEAR FROM p_date) = $year")->all();
        foreach($allPurchase as $key => $purchase){
            foreach($purchase->purchaseDetails as $key2 => $detail){
                $totalWeight += $detail->pd_rubber_weight;
            }
        }
        return $totalWeight;
    }

    public static function getLastPurchases($limit = 8){
        return Purchase::find()->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function getTotalWeight(){
        $totalWeight = 0;
        foreach($this->purchaseDetails as $key2 => $detail){
            $totalWeight += $detail->pd_rubber_weight;
        }
        return $totalWeight;
    }

    public function getTotal(){
        $total = 0;
        foreach($this->purchaseDetails as $key2 => $detail){
            $total += $detail->total;
        }
        return $total;
    }

    public static function getTotalPriceByDate($date){
        $total = 0;
        $purchases = self::getPurchasesByDate(Yii::$app->formatter->asDate($date, AppConstants::FORMAT_DB_DATE_PHP));
        foreach($purchases as $key1 => $purchase){
            $total += $purchase->total_dirty - $purchase->stamp - $purchase->labor - $purchase->commission;
        }
        return $total;
    }
}
