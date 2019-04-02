<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comment_log".
 *
 * @property int $id
 * @property int $request_id
 * @property int $comment_by
 * @property string $comment
 * @property string $update_at
 */
class CommentLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'comment_by', 'comment'], 'required'],
            [['request_id', 'comment_by'], 'integer'],
            [['update_at'], 'safe'],
            [['comment'], 'string', 'max' => 255],
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
            'comment_by' => 'Comment By',
            'comment' => 'Comment',
            'update_at' => 'Update At',
        ];
    }
}
