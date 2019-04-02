<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "claim_request_log".
 *
 * @property int $id
 * @property int $request_id
 * @property int $status_id
 * @property string $update_at
 */
class ClaimRequestLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'claim_request_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'status_id'], 'required'],
            [['request_id', 'status_id'], 'integer'],
            [['update_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'status_id' => 'Status ID',
            'update_at' => 'Update At',
        ];
    }
}
