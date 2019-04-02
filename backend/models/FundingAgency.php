<?php

namespace backend\models;

/**
 * This is the model class for table "funding_agency".
 *
 * @property int    $id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property int    $status
 */
class FundingAgency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funding_agency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['code'], 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message' => 'The {attribute} contain only alphanumeric & characters without space'],
            [['name'], 'trim'],
            [['name'], 'match', 'pattern' => '/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', 'message' => 'The {attribute} contain only characters'],
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
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public function getFundingAgencyBu()
    {
        return $this->hasMany(FundingAgencyBu::className(), ['funding_agency_id' => 'id']);
    }
}
