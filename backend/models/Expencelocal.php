<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "expence_convence".
 *
 * @property int $id
 * @property int $user_id Employee Code
 * @property int $status
 * @property string $vfrom Visit From
 * @property string $vto Visit To
 * @property string $mode
 * @property string $amount
 * @property string $amount_w Amount In Words
 * @property string $purpose
 * @property string $upload
 * @property string $date
 * @property string $dc
 * @property string $update_at
 *
 * @property User $user
 */
class Expencelocal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expence_convence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'vfrom', 'vto', 'mode', 'amount', 'amount_w', 'purpose', 'upload', 'date'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['date', 'update_at'], 'safe'],
            [['vfrom', 'vto', 'mode', 'upload'], 'string', 'max' => 100],
            [['amount_w', 'purpose'], 'string', 'max' => 255],
            [['dc'], 'string', 'max' => 30],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Employee Code',
            'status' => 'Status',
            'vfrom' => 'Visit From',
            'vto' => 'Visit To',
            'mode' => 'Mode',
            'amount' => 'Amount',
            'amount_w' => 'Amount In Words',
            'purpose' => 'Purpose',
            'upload' => 'Upload',
            'date' => 'Date',
            'dc' => 'Dc',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
