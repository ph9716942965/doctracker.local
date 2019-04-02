<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "expence".
 *
 * @property string $id
 * @property string $purpose
 * @property string $amount
 * @property string $expencetype
 * @property string $createby
 * @property string $dc
 * @property string $date
 */
class Expence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['id'], 'string', 'max' => 28],
            [['purpose'], 'string', 'max' => 255],
            [['expencetype'], 'string', 'max' => 20],
            [['createby'], 'string', 'max' => 10],
            [['dc'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purpose' => 'Purpose',
            'amount' => 'Amount',
            'expencetype' => 'Expencetype',
            'createby' => 'Createby',
            'dc' => 'Dc',
            'date' => 'Date',
        ];
    }
}
