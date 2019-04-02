<?php

namespace backend\models;

/**
 * This is the model class for table "ro".
 *
 * @property int             $id
 * @property int             $district_id
 * @property string          $code
 * @property string          $first_name
 * @property string          $last_name
 * @property string          $email_id
 * @property string          $contact_no
 * @property int             $status
 * @property int             $user_id
 * @property string          $created_at
 * @property string          $updated_at
 * @property AssetPurchase[] $assetPurchases
 * @property Employee[]      $employees
 * @property District        $district
 * @property User            $user
 */
class Ro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['district_id', 'code', 'first_name', 'last_name', 'email_id', 'contact_no'], 'required'],
            [['district_id', 'contact_no', 'status', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['first_name', 'last_name', 'email_id'], 'string', 'max' => 50],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['code', 'email_id', 'contact_no'], 'trim'],
            ['email_id', 'email'],
            [['email_id', 'code', 'contact_no'], 'unique', 'message' => 'This {attribute} has already been taken.'],
            [['code'], 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message' => 'The {attribute} contain only alphanumeric & characters without space'],
            [['first_name', 'last_name'], 'match', 'pattern' => '/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', 'message' => 'The {attribute} contain only characters'],
//            https://stackoverflow.com/questions/46448963/validation-pattern-in-yii2-form-to-allow-alphabet-space-and-some-symbol-only
//            [['code'], 'match', 'pattern' => '/^[0-9]*[a-zA-Z_]+[a-zA-Z0-9_]*$/', 'message' => 'The {attribute} contain only alphanumeric & characters'],
            ['email_id', 'userTableEmailExists'],
            [['code'], 'unique'],
            ['contact_no', 'match', 'pattern' => '/^[0-9]{10}$/', 'message' => 'The {attribute} contain exactly 10 numeric digits only'],
        ];
    }

    public function userTableEmailExists()
    {
        if (!empty($this->email_id)) {
            $olddata = isset($this->oldAttributes['email_id']) ? $this->oldAttributes['email_id'] : 1;
            if ($this->email_id != $olddata) {
                $user = User::find()->where(['email' => $this->email_id])->one();
                if (!empty($user)) {
                    $this->addError('email_id', 'This Email ID has already been taken in users');
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_id' => 'District Name',
            'code' => 'Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_id' => 'Email ID',
            'contact_no' => 'Contact No',
            'status' => 'Status',
            'user_id' => 'User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetPurchases()
    {
        return $this->hasMany(AssetPurchase::className(), ['ro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['ro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
