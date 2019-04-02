<?php

namespace backend\models;

/**
 * This is the model class for table "employee".
 *
 * @property int    $id
 * @property int    $ro_id
 * @property string $code
 * @property string $first_name
 * @property string $last_name
 * @property string $email_id
 * @property string $contact_no
 * @property int    $status
 * @property int    $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property User   $user
 * @property Ro     $ro
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ro_id', 'code', 'first_name', 'last_name', 'email_id', 'contact_no'], 'required'],
            [['ro_id', 'contact_no', 'status', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['first_name', 'last_name', 'email_id'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['ro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ro::className(), 'targetAttribute' => ['ro_id' => 'id']],
            [['code', 'email_id', 'contact_no'], 'trim'],
            ['email_id', 'email'],
            [['email_id', 'code', 'contact_no'], 'unique', 'message' => 'This {attribute} has already been taken.'],
            [['code'], 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message' => 'The {attribute} contain only alphanumeric & characters'],
//            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This {attribute} has already been taken.'],
            ['email_id', 'userTableEmailExists'],
            [['code'], 'unique'],
            ['email_id', 'email'],
            [['first_name', 'last_name'], 'trim'],
            [['first_name', 'last_name'], 'match', 'pattern' => '/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', 'message' => 'The {attribute} contain only characters'],
            ['contact_no', 'match', 'pattern' => '/^[0-9]{10}$/', 'message' => 'The {attribute} contain exactly 10 numeric digits only'],
            [['code'], 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message' => 'The {attribute} contain only alphanumeric & characters without space'],
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
            'ro_id' => 'Ro',
            'code' => 'Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_id' => 'Email',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRo()
    {
        return $this->hasOne(Ro::className(), ['id' => 'ro_id']);
    }
}
