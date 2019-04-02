<?php

namespace backend\models;

/**
 * This is the model class for table "vendor".
 *
 * @property int             $id
 * @property int             $ro_id
 * @property string          $vendor_no
 * @property string          $name_unit
 * @property string          $vendor_type         Staff,Service Contract,Meeting Participant,NGO,Supplier,Others
 * @property int             $applicability       Individual, Company
 * @property string          $salutation          Mr,Mrs,Ms,Dr
 * @property string          $first_name
 * @property string          $middle_name
 * @property string          $last_name
 * @property string          $nationality
 * @property string          $address
 * @property int             $district_id
 * @property int             $pincode
 * @property string          $email_id
 * @property string          $contact_no
 * @property string          $pan_no
 * @property string          $company_name
 * @property string          $parent_company_name
 * @property string          $website
 * @property string          $company_address
 * @property int             $company_pincode
 * @property int             $company_district_id
 * @property string          $bank_name
 * @property string          $branch_id
 * @property string          $branch_name
 * @property string          $branch_address
 * @property int             $bank_pincode
 * @property int             $bank_district_id
 * @property string          $bank_account_name
 * @property string          $bank_currency       INR, Euro, USD
 * @property string          $bank_account_no
 * @property string          $bank_account_type   Savings, Current
 * @property string          $ifsc_code
 * @property string          $swift_code
 * @property string          $iban
 * @property string          $cb_bank_name        CB-Correspondent Bank
 * @property string          $cb_address
 * @property string          $cb_account_no
 * @property string          $cb_swift_code
 * @property int             $status              active = 1 deactive = 2 delete  = 0
 * @property string          $updated_at
 * @property string          $created_at
 * @property AssetPurchase[] $assetPurchases
 * @property District        $district
 * @property Ro              $ro
 */
class Vendor extends \yii\db\ActiveRecord
{
    public $bank_country_id;
    public $bank_state_id;
    public $country_id;
    public $state_id;
    public $company_country_id;
    public $company_state_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ro_id', 'vendor_no', 'name_unit', 'vendor_type', 'applicability', 'salutation', 'first_name', 'last_name', 'address', 'district_id', 'pincode', 'email_id', 'contact_no', 'pan_no', 'bank_name', 'branch_id', 'branch_name',
            'branch_address', 'bank_pincode', 'bank_country_id', 'bank_state_id', 'bank_district_id', 'company_country_id', 'company_state_id', 'bank_account_name', 'bank_currency', 'bank_account_no', 'bank_account_type', 'ifsc_code', 'country_id', 'state_id', ], 'required'],
            [['ro_id', 'applicability', 'district_id', 'pincode', 'contact_no', 'company_pincode', 'company_district_id', 'bank_pincode', 'bank_district_id', 'status'], 'integer'],
            [['address', 'company_address', 'branch_address', 'cb_address'], 'string'],
            [['updated_at', 'created_at', 'state', 'company_country_id', 'company_state_id', 'comment'], 'safe'],
            [['vendor_no', 'name_unit', 'email_id', 'company_name', 'parent_company_name', 'bank_name', 'bank_account_name', 'cb_bank_name'], 'string', 'max' => 50],
            [['vendor_type', 'first_name', 'middle_name', 'last_name', 'website', 'branch_id', 'branch_name', 'bank_account_no', 'ifsc_code', 'swift_code', 'cb_account_no', 'cb_swift_code'], 'string', 'max' => 30],
            [['salutation'], 'string', 'max' => 5],
            [['nationality'], 'string', 'max' => 20],
            [['pan_no', 'bank_account_type'], 'string', 'max' => 15],
            [['bank_currency'], 'string', 'max' => 10],
            [['iban'], 'string', 'max' => 40],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['ro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ro::className(), 'targetAttribute' => ['ro_id' => 'id']],
            [['first_name', 'last_name', 'middle_name'], 'trim'],
            [['first_name', 'last_name', 'middle_name'], 'match', 'pattern' => '/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', 'message' => 'The {attribute} contain only characters'],
            [['pan_no'], 'match', 'pattern' => '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/', 'message' => 'Please specify a valid PAN Number'],
            ['pincode', 'match', 'pattern' => '/^[0-9]{6}$/', 'message' => 'The {attribute} contain exactly 6 numeric digits only'],
            ['contact_no', 'match', 'pattern' => '/^[0-9]{10}$/', 'message' => 'The {attribute} contain exactly 10 numeric digits only'],
            ['email_id', 'email'],
            ['company_name', 'required', 'when' => function ($model) {
                return $model->applicability === '1' ? true : false;
            }, 'whenClient' => "function (attribute, value) {
                  return $('input[type=\"radio\"][name=\"Vendor[applicability]\"]:checked').val() === '1';
            }"],
            ['parent_company_name', 'required', 'when' => function ($model) {
                return $model->applicability === '1' ? true : false;
            }, 'whenClient' => "function (attribute, value) {
                  return $('input[type=\"radio\"][name=\"Vendor[applicability]\"]:checked').val() === '1';
            }"],
            ['company_pincode', 'required', 'when' => function ($model) {
                return $model->applicability === '1' ? true : false;
            }, 'whenClient' => "function (attribute, value) {
                  return $('input[type=\"radio\"][name=\"Vendor[applicability]\"]:checked').val() === '1';
            }"],
            ['company_district_id', 'required', 'when' => function ($model) {
                return $model->applicability === '1' ? true : false;
            }, 'whenClient' => "function (attribute, value) {
                  return $('input[type=\"radio\"][name=\"Vendor[applicability]\"]:checked').val() === '1';
            }"],
            ['company_address', 'required', 'when' => function ($model) {
                return $model->applicability === '1' ? true : false;
            }, 'whenClient' => "function (attribute, value) {
                  return $('input[type=\"radio\"][name=\"Vendor[applicability]\"]:checked').val() === '1';
            }"],
            ['comment', 'required', 'when' => function ($model) {
                return $model->status === '2' ? true : false;
            }, 'whenClient' => "function (attribute, value) {
                return $('input[type=\"select\"][name=\"Vendor[status]\"]:selected').val() === '2';
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ro_id' => 'Ro',
            'vendor_no' => 'Vendor No',
            'name_unit' => 'Name Unit',
            'vendor_type' => 'Vendor Type',
            'applicability' => 'Applicability',
            'salutation' => 'Salutation',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'nationality' => 'Nationality',
            'address' => 'Address',
            'district_id' => 'District',
            'pincode' => 'Pincode',
            'email_id' => 'Email ID',
            'contact_no' => 'Contact No',
            'pan_no' => 'Pan No',
            'company_name' => 'Company Name',
            'parent_company_name' => 'Parent Company Name',
            'website' => 'Website',
            'company_address' => 'Company Address',
            'company_pincode' => 'Company Pincode',
            'company_district_id' => 'District name',
            'bank_name' => 'Bank Name',
            'branch_id' => 'Branch',
            'branch_name' => 'Branch Name',
            'branch_address' => 'Branch Address',
            'bank_pincode' => 'Bank Pincode',
            'bank_district_id' => 'Bank District',
            'bank_account_name' => 'Bank Account Name',
            'bank_currency' => 'Bank Currency',
            'bank_account_no' => 'Bank Account No',
            'bank_account_type' => 'Bank Account Type',
            'ifsc_code' => 'Ifsc Code',
            'swift_code' => 'Swift Code',
            'iban' => 'Iban',
            'cb_bank_name' => 'Cb Bank Name',
            'cb_address' => 'Cb Address',
            'cb_account_no' => 'Cb Account No',
            'cb_swift_code' => 'Cb Swift Code',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'bank_state_id' => 'Bank state name',
            'bank_country_id' => 'Banck country name',
            'company_state_id' => 'Company state name',
            'company_country_id' => 'Company country name',
            'state_id' => 'State name',
            'country_id' => 'Country name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetPurchases()
    {
        return $this->hasMany(AssetPurchase::className(), ['vendor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    public function getCompanyDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'company_district_id']);
    }

    public function getBankDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'bank_district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRo()
    {
        return $this->hasOne(Ro::className(), ['id' => 'ro_id']);
    }

    /// suresh
    const STAFF = 1;
    const SERVICE_CONTACT = 2;
    const METTING_PARTICIPANT = 3;
    const NGO = 4;
    const SUPPLIER = 5;
    const OTHERS = 6;

    public function getVendorType($id = null)
    {
        $list = array(
             self::STAFF => 'Staff',
             self::SERVICE_CONTACT => 'Service Contract',
             self::METTING_PARTICIPANT => 'Meeting Participant',
             self::NGO => 'NGO',
             self::SUPPLIER => 'Supplier',
             self::OTHERS => 'Others',
            );
        if ($id === null) {
            return $list;
        }
        if (is_numeric($id)) {
            return isset($list[$id]) ? $list[$id] : 'not defined';
        }

        return $id;
    }
}
