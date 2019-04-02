<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_levels".
 *
 * @property integer $id
 * @property string $level_name
 * @property string $level_authentications
 */
class UserLevels extends \yii\db\ActiveRecord {

    const EMPLOYEE = 1;
    const RO = 2;
    const HO = 3;
    const ACCOUNTS = 4;
    const ADMIN = 5;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_levels';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['level_name'], 'required'],
            [['level_name', 'level_authentications', 'level_type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'level_name' => 'Level Name',
            'level_authentications' => 'Level Authentications',
        ];
    }
    
     public function getLevelOptions($id = null) {
        $list = array(
            self::EMPLOYEE => 'Employee',
            self::RO => 'Ro',
            self::HO => 'Ho',
            self::ACCOUNTS => 'Accounts',
            self::ADMIN => 'Admin',
        );


        if ($id === null) {
            return $list;
        }
        if (is_numeric($id)) {
            return isset($list[$id]) ? $list[$id] : 'not defined';
        }
        return $id;
    }

}
