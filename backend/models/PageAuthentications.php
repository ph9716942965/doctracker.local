<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "page_authentications".
 *
 * @property integer $id
 * @property string $action
 * @property string $approve_to
 * @property string $notify_to
 * @property string $level_id
 */
class PageAuthentications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_authentications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['action', 'approve_to', 'level_id'], 'required'],
            [['authentication', 'approve_to', 'level_id','notify_to'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
            'approve_to' => 'Approve To',
            'level_id' => 'Level ID',
        ];
    }
}
