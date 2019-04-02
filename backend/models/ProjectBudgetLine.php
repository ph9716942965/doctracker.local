<?php

namespace backend\models;

/**
 * This is the model class for table "project_budget_line".
 *
 * @property int            $id
 * @property int            $project_id
 * @property string         $code
 * @property string         $name
 * @property string         $created_at
 * @property string         $updated_at
 * @property int            $status
 * @property ClaimRequest[] $claimRequests
 * @property Project        $project
 */
class ProjectBudgetLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_budget_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'code', 'name'], 'required'],
            [['project_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => 'Project',
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
    public function getClaimRequests()
    {
        return $this->hasMany(ClaimRequest::className(), ['project_budget_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
