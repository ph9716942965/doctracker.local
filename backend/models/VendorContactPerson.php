<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_contact_person".
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $name
 * @property string $title proprietor
 * @property string $address
 * @property string $contact_no
 * @property string $pan_no
 * @property string $service_tax_no
 * @property string $email_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 */
class VendorContactPerson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_contact_person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_id', 'name', 'title', 'contact_no', 'pan_no'], 'required'],
            [['vendor_id', 'contact_no', 'status'], 'integer'],
            [['address'], 'string'],
            [['service_tax_no'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'title', 'email_id'], 'string', 'max' => 30],
            [['pan_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vendor_id' => 'Vendor',
            'name' => 'Name',
            'title' => 'Title',
            'address' => 'Address',
            'contact_no' => 'Contact No',
            'pan_no' => 'Pan No',
            'service_tax_no' => 'Service Tax No',
            'email_id' => 'Email ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
