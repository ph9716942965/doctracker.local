<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "asset_purchase".
 *
 * @property int             $id
 * @property int             $ro_id
 * @property int             $asset_category_id
 * @property string          $name
 * @property string          $purpose
 * @property string          $members_of_purchase_committee
 * @property string          $date
 * @property int             $vendor_id
 * @property float           $amount
 * @property int             $project_id
 * @property string          $file_purchase_request_apporval
 * @property string          $file_quotation
 * @property string          $file_purchase_commite
 * @property string          $file_purchase_order
 * @property string          $file_pro_forma_final_invoice
 * @property string          $natural_head
 * @property int             $program_id
 * @property int             $funding_agency_id
 * @property int             $funding_agency_bu_id
 * @property int             $cost_centre_id
 * @property int             $cost_centre_sub_id
 * @property string          $lo
 * @property string          $ho_comment
 * @property string          $ref_number
 * @property string          $ref_date
 * @property string          $ac_comment
 * @property int             $status
 * @property int             $user_id
 * @property string          $created_at
 * @property string          $updated_at
 * @property AssetCategory   $assetCategory
 * @property CostCentre      $costCentre
 * @property CostCentreSub   $costCentreSub
 * @property Ro              $ro
 * @property Project         $project
 * @property User            $user
 * @property Vendor          $vendor
 * @property Program         $program
 * @property FundingAgency   $fundingAgency
 * @property FundingAgencyBu $fundingAgencyBu
 */
class AssetPurchase extends \yii\db\ActiveRecord
{
    public $reject;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        $R = ($this->reject != 'reject') ? AssetPurchseModelValidation(Yii::$app->user->identity->level_id) : ['user_id'];

        return [
            [$R, 'required'],
//            [['ro_id', 'asset_category_id', 'name', 'members_of_purchase_committee', 'date', 'vendor_id', 'amount', 'project_id', 'file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice', 'natural_head', 'program_id', 'funding_agency_id', 'funding_agency_bu_id', 'cost_centre_id', 'cost_centre_sub_id', 'lo', 'ref_number', 'ref_date', 'user_id'], 'required'],
            [['ro_id', 'asset_category_id', 'vendor_id', 'project_id', 'program_id', 'funding_agency_id', 'funding_agency_bu_id', 'cost_centre_id', 'cost_centre_sub_id', 'status', 'user_id'], 'integer'],
            [['date', 'ref_date', 'created_at', 'updated_at', 'file_purchase_request_apporval'], 'safe'],
            [['amount'], 'number'],
            [['ac_comment'], 'string'],
            [['name', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice', 'lo', 'ref_number'], 'string', 'max' => 100],
            [['purpose', 'members_of_purchase_committee', 'natural_head', 'ho_comment'], 'string', 'max' => 255],
            [['asset_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetCategory::className(), 'targetAttribute' => ['asset_category_id' => 'id']],
            [['cost_centre_id'], 'exist', 'skipOnError' => true, 'targetClass' => CostCentre::className(), 'targetAttribute' => ['cost_centre_id' => 'id']],
            [['cost_centre_sub_id'], 'exist', 'skipOnError' => true, 'targetClass' => CostCentreSub::className(), 'targetAttribute' => ['cost_centre_sub_id' => 'id']],
            [['ro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ro::className(), 'targetAttribute' => ['ro_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['funding_agency_id'], 'exist', 'skipOnError' => true, 'targetClass' => FundingAgency::className(), 'targetAttribute' => ['funding_agency_id' => 'id']],
            [['funding_agency_bu_id'], 'exist', 'skipOnError' => true, 'targetClass' => FundingAgencyBu::className(), 'targetAttribute' => ['funding_agency_bu_id' => 'id']],
//            [['file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice'], 'file', 'skipOnEmpty' => false],
            [['file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice'], 'file', 'extensions' => 'jpg, jpeg ,png'],
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
            'ro_id' => 'Ro ID',
            'asset_category_id' => 'Asset Category ID',
            'name' => 'Name',
            'purpose' => 'Purpose',
            'members_of_purchase_committee' => 'Members Of Purchase Committee',
            'date' => 'Date',
            'vendor_id' => 'Vendor ID',
            'amount' => 'Amount',
            'project_id' => 'Project ID',
            'file_purchase_request_apporval' => 'File Purchase Request Apporval',
            'file_quotation' => 'File Quotation',
            'file_purchase_commite' => 'File Purchase Commite',
            'file_purchase_order' => 'File Purchase Order',
            'file_pro_forma_final_invoice' => 'File Pro Forma Final Invoice',
            'natural_head' => 'Natural Head',
            'program_id' => 'Program ID',
            'funding_agency_id' => 'Funding Agency ID',
            'funding_agency_bu_id' => 'Funding Agency Bu ID',
            'cost_centre_id' => 'Cost Centre ID',
            'cost_centre_sub_id' => 'Cost Centre Sub ID',
            'lo' => 'Lo',
            'ho_comment' => 'Ho Comment',
            'ref_number' => 'Ref Number',
            'ref_date' => 'Ref Date',
            'ac_comment' => 'Ac Comment',
            'status' => 'Status',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetCategory()
    {
        return $this->hasOne(AssetCategory::className(), ['id' => 'asset_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostCentre()
    {
        return $this->hasOne(CostCentre::className(), ['id' => 'cost_centre_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostCentreSub()
    {
        return $this->hasOne(CostCentreSub::className(), ['id' => 'cost_centre_sub_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRo()
    {
        return $this->hasOne(Ro::className(), ['id' => 'ro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundingAgency()
    {
        return $this->hasOne(FundingAgency::className(), ['id' => 'funding_agency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundingAgencyBu()
    {
        return $this->hasOne(FundingAgencyBu::className(), ['id' => 'funding_agency_bu_id']);
    }

    public function uploadImage($model, $columnsArray = [])
    {
        foreach ($columnsArray as $col) {
            if (!empty($model->$col->tempName)) {
                $model->$col = $this->imageUplodeOns3($model->$col->tempName, round(microtime(true) * 1000).'.'.$model->$col->extension);
            }
        }
    }

    public function s3DeleteImages($imgURL)
    {
        $env = getenv('ENVIRONMENT');
        $env = 'development';
        $envWiseBucket = ['development' => 's3Local', 'staging' => 's3Staging', 'production' => 's3Production'];
        $componentName = $envWiseBucket['development'];
        $key = Yii::$app->$componentName->key;
        $secret = Yii::$app->$componentName->secret;
        $region = Yii::$app->$componentName->region;
        $bucket = Yii::$app->$componentName->bucket;
        // S3 Config
        $s3Client = new \Aws\S3\S3Client([
            'region' => $region,
            'version' => 'latest',
            'credentials' => [
                'key' => $key,
                'secret' => $secret,
            ],
        ]);
        $explode = explode('/', $imgURL);
        if (isset($explode[3])) {
            $path = urldecode($explode[3]);
            $delete = $s3Client->deleteObject([
                'Bucket' => $bucket,
                'Key' => $path,
            ]);
        }

        return true;
    }

    private function imageUplodeOns3($F, $N)
    {
        // $url = Url::current(['lg'=>NULL], TRUE);
        $env = getenv('ENVIRONMENT');
        // $_FILES['ClaimRequest']['name']['imageFile']
        // if(isset($FILES["ClaimRequest"]["tmp_name"]['imageFile']) && $FILES["ClaimRequest"]["tmp_name"]['imageFile']){
        //@$filePath = realpath($FILES["ClaimRequest"]["tmp_name"]['imageFile']);
        $filePath = $F;
        //print_r($filePath);
        //print_r($FILES);exit;
        // @$typeArr = explode("/",$FILES["ClaimRequest"]["type"]['imageFile']);
        @$photo_name = rand(0000, 9999).'_'.$N;

        if ($env == 'development') {
            $imageUrl = Yii::$app->s3Local->upload($filePath, [
                'override' => true,
                'Key' => $photo_name,
                'CacheControl' => 'max-age='.strtotime('+1 year'),
            ]);
        } elseif ($env == 'staging') {
            $imageUrl = Yii::$app->s3Staging->upload($filePath, [
                'override' => true,
                'Key' => $photo_name,
                'CacheControl' => 'max-age='.strtotime('+1 year'),
            ]);
        } else {
            $imageUrl = Yii::$app->s3Production->upload($filePath, [
                'override' => true,
                'Key' => $photo_name,
                'CacheControl' => 'max-age='.strtotime('+1 year'),
            ]);
        }
        if ($imageUrl) {
            return $imageUrl;
        //$model->photo = $imageUrl;
        } else {
            return null;
        }
        // }
    }
}
