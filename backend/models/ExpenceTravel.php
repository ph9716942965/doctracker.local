<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "expence_travel".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $vfrom Visit From
 * @property string $vto Visit To
 * @property string $mode
 * @property string $purpose
 * @property string $fare
 * @property string $convence Local  Conveyance
 * @property string $hexpence Hotel  Expenses
 * @property string $miscellaneous
 * @property string $food
 * @property string $travelapproval Travel Approval
 * @property string $tickets Tickets
 * @property string $hotelbill Hotel Bills
 * @property string $taxibill Local Taxi Bills
 * @property string $foodbill Food Bills
 * @property string $date
 * @property string $dc
 * @property string $update_at
 *
 * @property User $user
 */
class ExpenceTravel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expence_travel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'vfrom', 'vto', 'mode', 'purpose', 'fare', 'convence', 'hexpence', 'miscellaneous', 'food', 'travelapproval', 'tickets', 'hotelbill', 'taxibill', 'foodbill', 'date'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['fare', 'convence', 'hexpence', 'miscellaneous', 'food'], 'number'],
            [['date', 'update_at'], 'safe'],
            [['vfrom', 'vto'], 'string', 'max' => 100],
            [['mode'], 'string', 'max' => 50],
            [['purpose', 'travelapproval', 'tickets', 'hotelbill', 'taxibill', 'foodbill'], 'string', 'max' => 255],
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
            'user_id' => 'User',
            'status' => 'Status',
            'vfrom' => 'Visit From',
            'vto' => 'Visit To',
            'mode' => 'Mode',
            'purpose' => 'Purpose',
            'fare' => 'Fare',
            'convence' => 'Local  Conveyance',
            'hexpence' => 'Hotel  Expenses',
            'miscellaneous' => 'Miscellaneous',
            'food' => 'Food',
            'travelapproval' => 'Travel Approval',
            'tickets' => 'Tickets',
            'hotelbill' => 'Hotel Bills',
            'taxibill' => 'Local Taxi Bills',
            'foodbill' => 'Food Bills',
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
