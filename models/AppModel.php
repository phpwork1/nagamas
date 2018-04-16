<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 13/3/2018
 * Time: 9:26 AM
 */

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use Yii;
use app\components\base\AppConstants;

class AppModel extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by'
            ],
            TimestampBehavior::className(),
        ];
    }

    public function delete() {

        try {
            return parent::delete();
        } catch (\Exception $ex) {
            Yii::$app->session->addFlash('danger', $ex->getMessage());
            Yii::$app->session->addFlash('danger', AppConstants::ERR_INTEGRITY_CONSTRAINT_VIOLATION);
            return false;
        }
    }
}