<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_payment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status_id
 * @property int $vendor_id
 * @property string $service_by
 * @property string $amount
 * @property string $purpose
 * @property int $project_id
 * @property string $upload_approval
 * @property string $upload_bill
 * @property string $natural_head
 * @property int $program_id
 * @property int $funding_agency_id
 * @property int $funding_agency_bu_id
 * @property int $cost_center_id
 * @property int $cost_centre_sub
 * @property string $lo
 * @property string $comment_ho
 * @property string $cv_ref
 * @property string $cr_date
 * @property string $comment_ac
 *
 * @property Vendor $vendor
 * @property Project $project
 * @property Program $program
 * @property FundingAgency $fundingAgency
 * @property FundingAgencyBu $fundingAgencyBu
 * @property CostCentre $costCenter
 * @property CostCentreSub $costCentreSub
 */
class VendorPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_payment';
    }

    /**
     * {@inheritdoc}
     */
    const SCENARIO_UPDATE = 'update';
   
    public $imgvalid;
    public $imageFile;
    public $imageFile2;
    public $Required=''; //Checkuser($_SESSION['login_info']['username'])
    // echo "<h1>".$this->scenario;exit;
        //$EMP=['user_id','state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose'];
        //$RO=['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose','fund_agency','nature_service','ro_comment'];
        //$HO=['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose','fund_agency','nature_service','ro_comment','naturehead','project_id','project_budget_line_id','costcenter_id','program_id','locationdescription_id','ho_comment'];
        //$AC=['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose','fund_agency','nature_service','ro_comment','naturehead','project_id','project_budget_line_id','costcenter_id','program_id','locationdescription_id','ho_comment','tds','advance','net','refnumber','refdate'];
       
       // $Required=($this->reject!='reject')?ClaimRequestModelValidation($_SESSION['login_info']['username']):['user_id','state_id'];
      
    public function rules()
    {
        $Rule=\CheckAuth2::obj($_SESSION['login_info']['username'])->Checkuser();
        $RO=['user_id', 'status_id', 'vendor_id', 'service_by', 'amount', 'purpose', 'project_id'];
        $HO=array_merge($RO,['program_id','funding_agency_id','funding_agency_bu_id','cost_center_id','cost_centre_sub','lo','comment_ho']);
        $AC=array_merge($HO,['cv_ref','cr_date','comment_ac']);
        
       /* $RO=['user_id', 'status_id', 'vendor_id', 'service_by', 'amount', 'purpose', 'project_id','imageFile','imageFile2'];
        $HO=['user_id', 'status_id', 'vendor_id', 'service_by', 'amount', 'purpose', 'project_id','imageFile','imageFile2','program_id','funding_agency_id','funding_agency_bu_id','cost_center_id','cost_centre_sub','lo','comment_ho'];
        $AC=['user_id', 'status_id', 'vendor_id', 'service_by', 'amount', 'purpose', 'project_id','imageFile','imageFile2','program_id','funding_agency_id','funding_agency_bu_id','cost_center_id','cost_centre_sub','lo','comment_ho','cv_ref','cr_date','comment_ac'];
       */ return [
            [$$Rule, 'required'],
           // [['upload_approval','upload_bill'], 'file', 'skipOnEmpty' => ($this->imgvalid === self::SCENARIO_UPDATE), 'extensions' => 'png, jpg'],
            [['imageFile','imageFile2'], 'file', 'skipOnEmpty' => ($this->imgvalid === self::SCENARIO_UPDATE), 'extensions' => 'png, jpg','maxFiles' => 5],
            [['user_id', 'status_id', 'vendor_id', 'project_id', 'program_id', 'funding_agency_id', 'funding_agency_bu_id', 'cost_center_id', 'cost_centre_sub'], 'integer'],
            [['amount'], 'number'],
            [['upload_bill', 'upload_approval'], 'safe'],
            [['service_by', 'natural_head', 'lo'], 'string', 'max' => 191],
            [['purpose', 'comment_ho', 'comment_ac','upload_bill', 'upload_approval'], 'string', 'max' => 255],
            [['cv_ref'], 'string', 'max' => 60],
            [['cr_date'], 'string', 'max' => 30],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['funding_agency_id'], 'exist', 'skipOnError' => true, 'targetClass' => FundingAgency::className(), 'targetAttribute' => ['funding_agency_id' => 'id']],
            [['funding_agency_bu_id'], 'exist', 'skipOnError' => true, 'targetClass' => FundingAgencyBu::className(), 'targetAttribute' => ['funding_agency_bu_id' => 'id']],
            [['cost_center_id'], 'exist', 'skipOnError' => true, 'targetClass' => CostCentre::className(), 'targetAttribute' => ['cost_center_id' => 'id']],
            [['cost_centre_sub'], 'exist', 'skipOnError' => true, 'targetClass' => CostCentreSub::className(), 'targetAttribute' => ['cost_centre_sub' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'vendor_id' => 'Vendor ID',
            'service_by' => 'Service By',
            'amount' => 'Amount',
            'purpose' => 'Purpose',
            'project_id' => 'Project ID',
            'upload_approval' => 'Upload Approval',
            'upload_bill' => 'Upload Bill',
            'natural_head' => 'Natural Head',
            'program_id' => 'Program ID',
            'funding_agency_id' => 'Funding Agency ID',
            'funding_agency_bu_id' => 'Funding Agency Bu ID',
            'cost_center_id' => 'Cost Center ID',
            'cost_centre_sub' => 'Cost Centre Sub',
            'lo' => 'Lo',
            'comment_ho' => 'Comment Ho',
            'cv_ref' => 'Cv Ref',
            'cr_date' => 'Cr Date',
            'comment_ac' => 'Comment Ac',
            'imageFile'=>'Upload Approval File',
            'imageFile2'=>'Upload Bill File'
        ];
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
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostCenter()
    {
        return $this->hasOne(CostCentre::className(), ['id' => 'cost_center_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostCentreSub()
    {
        return $this->hasOne(CostCentreSub::className(), ['id' => 'cost_centre_sub']);
    }

    public function upload($url=null,$update=false,$bill_type=null)
    {
        if ($this->validate()) {
            if($update){
                if($bill_type=='upload_approval'){
                    foreach ($this->imageFile as $file) {
                        $this->upload_approval=$this->imageUplodeOns3($file->tempName,$file->name);
                        if($this->s3DeleteImages($url)){
                            return true;
                        }
                    }
                }elseif($bill_type=='upload_bill'){
                    foreach ($this->imageFile2 as $file2) {
                        $this->upload_bill=$this->imageUplodeOns3($file2->tempName,$file2->name);
                        if($this->s3DeleteImages($url)){
                            return true;
                        }
                    }
                }  
                
            }else{
            foreach ($this->imageFile as $file) {
                $this->upload_approval=$this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension);
               // $fdb->save();
            }
            foreach ($this->imageFile2 as $file) {
                $this->upload_bill=$this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension);
               // $fdb->save();
            }
            return true;
        }} else {
            return false;
        }
    }

    public function s3DeleteImages($imgURL) {
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

    private function imageUplodeOns3($F,$N){
        $env = getenv("ENVIRONMENT");
         $filePath=$F;
            @$photo_name = "DTVendor_".rand(10,100)."_".$N;
            if($env == "development"){
                $imageUrl = Yii::$app->s3Local->upload($filePath, [
                    'override' => true,
                    'Key' => $photo_name, 
                    'CacheControl' => 'max-age=' . strtotime('+1 year')  
                ]);
            } else if($env == "staging"){
                $imageUrl = Yii::$app->s3Staging->upload($filePath, [
                    'override' => true,
                    'Key' => $photo_name, 
                    'CacheControl' => 'max-age=' . strtotime('+1 year')  
                ]);                    
            } else{
                $imageUrl = Yii::$app->s3Production->upload($filePath, [
                    'override' => true,
                    'Key' => $photo_name, 
                    'CacheControl' => 'max-age=' . strtotime('+1 year')  
                ]);
            }
            if($imageUrl){
                return $imageUrl;
            }else{
                return NULL;
            }
    }
}
