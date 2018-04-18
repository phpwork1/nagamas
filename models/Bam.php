<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;

/**
 * This is the model class for table "bam".
 *
 * @property int $id
 * @property int $driver_id
 * @property int $car_id
 * @property int $area_id
 * @property string $b_date
 * @property int $b_price
 * @property int $b_bruto
 * @property int $b_tarra
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Car $car
 * @property Driver $driver
 * @property Area $area
 */
class Bam extends AppModel
{
    public $netto;
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'car_id', 'area_id', 'b_date'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['driver_id', 'car_id', 'area_id', 'b_price', 'b_bruto', 'b_tarra'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
            [['b_date'], 'safe'],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => sprintf("%s %s", AppLabels::NAME, AppLabels::DRIVER),
            'car_id' => sprintf("%s %s", AppLabels::NAME, AppLabels::CAR),
            'area_id' => sprintf("%s %s", AppLabels::NAME, AppLabels::AREA),
            'b_price' => AppLabels::PRICE,
            'b_bruto' => AppLabels::BRUTO,
            'b_tarra' => AppLabels::TARRA,
            'b_date' => AppLabels::DATE,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if (!$this->b_date == '') {
            $this->b_date = Yii::$app->formatter->asDate($this->b_date, AppConstants::FORMAT_DB_DATE_PHP);
        }


        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if (!$this->b_date == '') {
            $this->b_date = Yii::$app->formatter->asDate($this->b_date, AppConstants::FORMAT_DATE_PHP_SHOW_MONTH);
        }

        $this->netto = $this->b_bruto-$this->b_tarra;
        $this->total = $this->netto*$this->b_price;
    }
}
