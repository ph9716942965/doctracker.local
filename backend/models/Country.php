<?php

namespace backend\models;

/**
 * This is the model class for table "country".
 *
 * @property int     $id
 * @property string  $code
 * @property string  $country_name
 * @property string  $created_at
 * @property string  $updated_at
 * @property int     $status
 * @property State[] $states
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'country_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['country_name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['code'], 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message' => 'The {attribute} contain only alphanumeric & characters without space'],
            [['country_name'], 'trim'],
            [['country_name'], 'match', 'pattern' => '/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', 'message' => 'The {attribute} contain only characters'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'country_name' => 'Country Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(State::className(), ['country_id' => 'id']);
    }
}
