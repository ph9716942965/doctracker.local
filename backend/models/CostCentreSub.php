<?php

namespace backend\models;

/**
 * This is the model class for table "cost_centre_sub".
 *
 * @property int        $id
 * @property int        $cost_centre_id
 * @property string     $code
 * @property string     $name
 * @property string     $created_at
 * @property string     $updated_at
 * @property int        $status
 * @property CostCentre $costCentre
 */
class CostCentreSub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cost_centre_sub';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cost_centre_id', 'code', 'name'], 'required'],
            [['cost_centre_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 255],
            [['cost_centre_id'], 'exist', 'skipOnError' => true, 'targetClass' => CostCentre::className(), 'targetAttribute' => ['cost_centre_id' => 'id']],
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
            'cost_centre_id' => 'Cost Centre',
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
    public function getCostCentre()
    {
        return $this->hasOne(CostCentre::className(), ['id' => 'cost_centre_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaimRequests()
    {
        return $this->hasMany(ClaimRequest::className(), ['costcenter_id' => 'id']);
    }
}
