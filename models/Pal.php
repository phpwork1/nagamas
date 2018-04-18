<?php

namespace app\models;

use app\components\base\AppConstants;
use Yii;
use app\components\base\AppLabels;


/**
 * This is the model class for table "pal".
 *
 * @property int $id
 * @property int $driver_id
 * @property int $car_id
 * @property int $area_id
 * @property string $p_date
 * @property int $p_price
 * @property int $p_bruto
 * @property int $p_tarra
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Driver $driver
 * @property Car $car
 * @property Area $area
 */
class Pal extends AppModel
{
    public $netto;
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'car_id', 'area_id', 'p_date'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['driver_id', 'car_id', 'area_id', 'p_price', 'p_bruto', 'p_tarra'], 'integer', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['p_date'], 'safe'],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
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
            'p_price' => AppLabels::PRICE,
            'p_bruto' => AppLabels::BRUTO,
            'p_tarra' => AppLabels::TARRA,
            'p_date' => AppLabels::DATE
        ];
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
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
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

        $this->netto = $this->p_bruto-$this->p_tarra;
        $this->total = $this->netto*$this->p_price;
    }
}
