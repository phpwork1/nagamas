<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use Yii;

/**
 * This is the model class for table "ram".
 *
 * @property int $id
 * @property int $driver_id
 * @property int $car_id
 * @property int $area_id
 * @property string $r_date
 * @property int $r_price
 * @property int $r_bruto
 * @property int $r_tarra
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Car $car
 * @property Driver $driver
 * @property Area $area
 */
class Ram extends AppModel
{
    public $netto;
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ram';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'car_id', 'area_id', 'r_date'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['driver_id', 'car_id', 'area_id', 'r_price', 'r_bruto', 'r_tarra'], 'integer', 'message' => AppConstants::VALIDATE_INTEGER],
            [['r_date'], 'safe'],
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
            'r_price' => AppLabels::PRICE,
            'r_bruto' => AppLabels::BRUTO,
            'r_tarra' => AppLabels::TARRA,
            'r_date' => AppLabels::DATE,
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

        if (!$this->r_date == '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConstants::FORMAT_DB_DATE_PHP);
        }


        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if (!$this->r_date == '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConstants::FORMAT_DATE_PHP_SHOW_MONTH);
        }

        $this->netto = $this->r_bruto-$this->r_tarra;
        $this->total = $this->netto*$this->r_price;
    }
}
