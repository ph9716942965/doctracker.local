<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property int $id
 * @property string $name
 */
class Level extends \yii\db\ActiveRecord {

    const EMPLOYEE = 1;
    const RO = 2;
    const HO = 3;
    const ACCOUNTS = 4;
    const ADMIN = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
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
