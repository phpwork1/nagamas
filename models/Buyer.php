<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "buyer".
 *
 * @property int $id
 * @property string $b_name
 */
class Buyer extends AppModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buyer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_name'], 'required'],
            [['b_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * Return model objects
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return \yii\db\ActiveRecord[]
     */
    public static function getAll($value = 'b_name', $conditions = null) {
        $query = Buyer::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 'b_name', $conditions = null) {
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
            'b_name' => 'Nama Pembeli',
        ];
    }
}
