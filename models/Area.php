<?php

namespace app\models;

use app\components\base\AppConstants;
use app\components\base\AppLabels;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "area".
 *
 * @property int $id
 * @property string $a_name
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 *
 * @property Bam[] $bams
 * @property Pal[] $pals
 * @property Ram[] $rams
 */
class Area extends AppModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_name'], 'required', 'message' => AppConstants::VALIDATE_REQUIRED],
            [['a_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'a_name' => sprintf("%s %s", AppLabels::NAME, AppLabels::AREA),
        ];
    }

    /**
     * Return model objects
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return \yii\db\ActiveRecord[]
     */
    public static function getAll($value = 'a_name', $conditions = null) {
        $query = Area::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 'a_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);

        return $map;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBams()
    {
        return $this->hasMany(Bam::className(), ['area_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPals()
    {
        return $this->hasMany(Pal::className(), ['area_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRams()
    {
        return $this->hasMany(Ram::className(), ['area_id' => 'id']);
    }
}
