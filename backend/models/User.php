<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $level_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ClaimRequest[] $claimRequests
 * @property ExpenceConvence[] $expenceConvences
 * @property ExpenceOther[] $expenceOthers
 * @property ExpenceTravel[] $expenceTravels
 * @property Request[] $requests
 * @property TravelExpenses[] $travelExpenses
 */
class User extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['parent_id', 'username', 'password_hash', 'email'], 'required'],
            [['parent_id', 'level_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email', 'username', 'password_reset_token'], 'unique'],
            [['email', 'username'], 'trim'],
            [['password_hash'], 'match', 'pattern' => '((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]))', 'message' => 'Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 8 or more characters'],
            ['password_hash', 'string', 'min' => 8, 'tooShort' => 'Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 8 or more characters'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'level_id' => 'Level',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaimRequests() {
        return $this->hasMany(ClaimRequest::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenceConvences() {
        return $this->hasMany(ExpenceConvence::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenceOthers() {
        return $this->hasMany(ExpenceOther::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenceTravels() {
        return $this->hasMany(ExpenceTravel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests() {
        return $this->hasMany(Request::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTravelExpenses() {
        return $this->hasMany(TravelExpenses::className(), ['user_id' => 'id']);
    }

    public static function getSessionUserId() {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if (isset($session['login_info'])) {
            return $session['login_info']->user->id;
        }
    }

    public static function roPassword() {
//        $random = rand(000000, 999999);
        $random = 123456;
        return $random;
    }
    public static function employeePassword() {
//        $random = rand(000000, 999999);
        $random = 123456;
        return $random;
    }

    public function get_empname($id){
        return \backend\models\User::find()->select('username')->where(["id"=>$id])->asArray()->one()['username'];

      //  return $this->username; 
    }
}
