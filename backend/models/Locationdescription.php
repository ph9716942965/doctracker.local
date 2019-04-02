<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "locationdescription".
 *
 * @property int $id
 * @property string $dis
 * @property string $create_at
 * @property string $update_at
 * @property int $status
 *
 * @property ClaimRequest[] $claimRequests
 */
class Locationdescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locationdescription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dis'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['status'], 'integer'],
            [['dis'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dis' => 'Dis',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaimRequests()
    {
        return $this->hasMany(ClaimRequest::className(), ['locationdescription_id' => 'id']);
    }
}
