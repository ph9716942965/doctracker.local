<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "expence_other".
 *
 * @property int $id
 * @property int $user_id Employee Code
 * @property int $status
 * @property string $amount
 * @property string $amount_w Amount (In Words)
 * @property string $purpose
 * @property string $invoice Cash Memo / Invoice
 * @property string $date
 * @property string $dc
 * @property string $update_at
 *
 * @property User $user
 */
class ExpenceOther extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expence_other';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'amount', 'amount_w', 'purpose', 'invoice', 'date'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['date', 'update_at'], 'safe'],
            [['amount_w', 'purpose', 'invoice'], 'string', 'max' => 255],
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
            'amount' => 'Amount',
            'amount_w' => 'Amount (In Words)',
            'purpose' => 'Purpose',
            'invoice' => 'Cash Memo / Invoice',
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
