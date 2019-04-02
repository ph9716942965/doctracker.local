<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "funding_agency_bu".
 *
 * @property int $id
 * @property int $funding_agency_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property AssetPurchase[] $assetPurchases
 * @property FundingAgency $fundingAgency
 */
class FundingAgencyBu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funding_agency_bu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['funding_agency_id', 'code', 'name'], 'required'],
            [['funding_agency_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 100],
            [['funding_agency_id'], 'exist', 'skipOnError' => true, 'targetClass' => FundingAgency::className(), 'targetAttribute' => ['funding_agency_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'funding_agency_id' => 'Funding Agency ID',
            'code' => 'Code',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetPurchases()
    {
        return $this->hasMany(AssetPurchase::className(), ['funding_agency_bu_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundingAgency()
    {
        return $this->hasOne(FundingAgency::className(), ['id' => 'funding_agency_id']);
    }
}
