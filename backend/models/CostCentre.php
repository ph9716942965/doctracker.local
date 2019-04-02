<?php

namespace backend\models;

/**
 * This is the model class for table "cost_centre".
 *
 * @property int             $id
 * @property string          $code
 * @property string          $name
 * @property string          $created_at
 * @property string          $updated_at
 * @property int             $status
 * @property ClaimRequest[]  $claimRequests
 * @property CostCentreSub[] $costCentreSubs
 * @property Request[]       $requests
 */
class CostCentre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cost_centre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['created_at', 'updated_at','name'], 'safe'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['code'], 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message' => 'The {attribute} contain only alphanumeric & characters without space'],
            [['name'], 'trim'],
           // [['name'], 'match', 'pattern' => '/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', 'message' => 'The {attribute} contain only characters'],
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
            'name' => 'Cost Center Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostCentreSubs()
    {
        return $this->hasMany(CostCentreSub::className(), ['cost_centre_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
  /*  public function getRequests()
    {
        return $this->hasMany(Request::className(), ['costcentre_id' => 'id']);
    } */
   
}
