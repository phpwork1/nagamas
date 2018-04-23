<?php

namespace app\models;

use app\components\base\AppLabels;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "driver".
 *
 * @property int $id
 * @property string $d_name
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Bam[] $bams
 * @property Pal[] $pals
 * @property Ram[] $rams
 */
class Driver extends AppModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['d_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * Return model objects
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return \yii\db\ActiveRecord[]
     */
    public static function getAll($value = 'd_name', $conditions = null) {
        $query = Driver::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 'd_name', $conditions = null) {
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
            'd_name' => sprintf("%s %s", AppLabels::NAME, AppLabels::DRIVER),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBams()
    {
        return $this->hasMany(Bam::className(), ['driver_id' => 'id'])->orderBy(['b_date' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPals()
    {
        return $this->hasMany(Pal::className(), ['driver_id' => 'id'])->orderBy(['p_date' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRams()
    {
        return $this->hasMany(Ram::className(), ['driver_id' => 'id'])->orderBy(['r_date' => SORT_DESC]);
    }
}
