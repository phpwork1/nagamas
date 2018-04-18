<?php

namespace app\models;

use app\components\base\AppLabels;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $c_name
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Bam[] $bams
 * @property Pal[] $pals
 *
 */
class Car extends AppModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * Return model objects
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return \yii\db\ActiveRecord[]
     */
    public static function getAll($value = 'c_name', $conditions = null) {
        $query = Car::find()->orderBy([$value => SORT_ASC]);
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }
        return $query->all();
    }

    /**
     * Return array of key => value for dropdown menu
     * @param string $key default to 'id'
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return array
     */
    public static function map($key = 'id', $value = 'c_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);

        return $map;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_name' => sprintf("%s %s", AppLabels::PLAT, AppLabels::CAR),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBams()
    {
        return $this->hasMany(Bam::className(), ['car_id' => 'id'])->orderBy(['b_date' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPals()
    {
        return $this->hasMany(Pal::className(), ['car_id' => 'id'])->orderBy(['p_date' => SORT_DESC]);
    }
}
