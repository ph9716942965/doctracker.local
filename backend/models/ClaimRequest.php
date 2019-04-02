<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "claim_request".
 *
 * @property int $id
 * @property int $user_id Employee Code
 * @property int $state_id Level Id
 * @property string $visit_from Visit From
 * @property string $visit_to Visit To
 * @property string $mode Mode
 * @property string $date
 * @property string $amount
 * @property string $amount2 Fare
 * @property string $amount3 Hotel Expenses
 * @property string $amount5 Miscellaneous
 * @property string $amountinword Amount In Words
 * @property string $purpose
 * @property string $dc
 * @property string $fund_agency Funding Agency
 * @property string $nature_service Nature of Services 
 * @property string $ro_comment Ro Comment
 * @property string $naturehead Natural Head
 * @property int $project_id
 * @property int $project_budget_line_id
 * @property int $costcenter_id
 * @property int $program_id
 * @property int $locationdescription_id
 * @property string $ho_comment
 * @property string $tds
 * @property string $advance
 * @property string $net
 * @property string $refnumber
 * @property string $refdate
 * @property string $create_at
 * @property string $update_at
 * @property int $active
 *
 * @property User $user
 * @property Project $project
 * @property ProjectBudgetLine $projectBudgetLine
 * @property CostCentre $costcenter
 * @property Program $program
 * @property Locationdescription $locationdescription
 */
class ClaimRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $name;
    public static function tableName()
    {
        return 'claim_request';
    }
public $imageFile;
public $imageFile2;
public $imageFile3;
public $imageFile4;
public $imageFile5;
public $imgvalid;
public $reject;
    /**
     * {@inheritdoc}
     */
    const SCENARIO_UPDATE = 'update'; 
    public function rules()
    {
       // echo "<h1>".$this->scenario;exit;
        //$EMP=['user_id','state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose'];
        //$RO=['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose','fund_agency','nature_service','ro_comment'];
        //$HO=['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose','fund_agency','nature_service','ro_comment','naturehead','project_id','project_budget_line_id','costcenter_id','program_id','locationdescription_id','ho_comment'];
        //$AC=['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4','amount5', 'amountinword','purpose','fund_agency','nature_service','ro_comment','naturehead','project_id','project_budget_line_id','costcenter_id','program_id','locationdescription_id','ho_comment','tds','advance','net','refnumber','refdate'];
       
       $R=($this->reject!='reject')?ClaimRequestModelValidation($_SESSION['login_info']['username']):['user_id','state_id'];
        
        return [
            [$R, 'required'],
            [['imageFile','imageFile2','imageFile3','imageFile4','imageFile5'], 'file', 'skipOnEmpty' => ($this->imgvalid === self::SCENARIO_UPDATE), 'extensions' => 'png, jpg','maxFiles' => 5],
            [['user_id', 'state_id', 'project_id', 'project_budget_line_id', 'costcenter_id', 'program_id', 'locationdescription_id', 'active'], 'integer'],
            [['date', 'refdate', 'create_at', 'update_at'], 'safe'],
            [['amount', 'amount2', 'amount3', 'amount5', 'tds', 'advance', 'net'], 'number'],
            [['visit_from', 'visit_to', 'mode', 'purpose', 'fund_agency', 'nature_service', 'naturehead'], 'string', 'max' => 100],
            [['amountinword'], 'string', 'max' => 150],
            [['dc'], 'string', 'max' => 50],
            [['ro_comment', 'ho_comment'], 'string', 'max' => 255],
            [['refnumber'], 'string', 'max' => 30],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['project_budget_line_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBudgetLine::className(), 'targetAttribute' => ['project_budget_line_id' => 'id']],
            [['costcenter_id'], 'exist', 'skipOnError' => true, 'targetClass' => CostCentreSub::className(), 'targetAttribute' => ['costcenter_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['locationdescription_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locationdescription::className(), 'targetAttribute' => ['locationdescription_id' => 'id']],
            [['fund_agency'], 'exist', 'skipOnError' => true, 'targetClass' => FundingAgency::className(), 'targetAttribute' => ['fund_agency' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */ 

    public function upload($reqid=null,$url=null)
    {
        if ($this->validate()) {
            if($url){
                $connection = Yii::$app->getDb();
                $fil = Upload::find($reqid)->where('id = '.$reqid);
                foreach ($this->imageFile as $file) {
                    $connection->createCommand()->update('upload', ['url' => $this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension),], ['id' => $reqid])->execute();
                    if($this->s3DeleteImages($url)){
                        //echo "Image delete <br>".$url;exit;
                        return true;
                    }
                }
            }else{
            $fdb=new Upload;
            $fdb->request_id=$reqid;
            foreach ($this->imageFile as $file) {
               // print_r($file);exit;
                $fdb->url=$this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension);
               // $fdb->url='uploads/' . $file->baseName . '.' . $file->extension;
                $fdb->save();
                //$file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        }} else {
            return false;
        }
    }

    public function upload2($reqid=null,$url=null){
        //if ($this->validate()) {
            if($url){
                $connection = Yii::$app->getDb();
                foreach ($this->imageFile2 as $file) {
                    $connection->createCommand()->update('upload', ['url' => $this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension),], ['id' => $reqid])->execute();
                    $this->s3DeleteImages($url);
                    return true;
                }
            }else{
            $fdb=new Upload;$fdb->request_id=$reqid;
            foreach ($this->imageFile2 as $file) {
                $fdb->url=$this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension);
               // $fdb->url='uploads/' . $file->baseName . '.' . $file->extension;
                $fdb->save();//$file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }return true;
        //} else {return false;}
    }}
    public function upload3($reqid=null,$url=null){
        //if ($this->validate()) {
            if($url){
                $connection = Yii::$app->getDb();
               foreach ($this->imageFile3 as $file) {
                    $connection->createCommand()->update('upload', ['url' => $this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension),], ['id' => $reqid])->execute();
                    $this->s3DeleteImages($url);
                    return true;
                }
            }else{
            $fdb=new Upload;$fdb->request_id=$reqid;
            foreach ($this->imageFile3 as $file) {
                $fdb->url=$this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension);
               // $fdb->url='uploads/' . $file->baseName . '.' . $file->extension;
                $fdb->save();//$file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }return true;
        //} else {return false;}
    }}
    public function upload4($reqid=null,$url=null){
        //if ($this->validate()) {
            if($url){
                $connection = Yii::$app->getDb();
                foreach ($this->imageFile4 as $file) {
                    $connection->createCommand()->update('upload', ['url' => $this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension),], ['id' => $reqid])->execute();
                    $this->s3DeleteImages($url);
                    return true;
                }
            }else{
            $fdb=new Upload;$fdb->request_id=$reqid;
            foreach ($this->imageFile4 as $file) {
                $fdb->url=$this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension);
               // $fdb->url='uploads/' . $file->baseName . '.' . $file->extension;
                $fdb->save();//$file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }return true;
        //} else {return false;}
    }}
    public function upload5($reqid=null,$url=null){
       // if ($this->validate()) {
        if($url){
            $connection = Yii::$app->getDb();
            foreach ($this->imageFile5 as $file) {
                $connection->createCommand()->update('upload', ['url' => $this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension),], ['id' => $reqid])->execute();
                $this->s3DeleteImages($url);
                return true;
            }
        }else{
            $fdb=new Upload;$fdb->request_id=$reqid;
            foreach ($this->imageFile5 as $file) {
                $fdb->url=$this->imageUplodeOns3($file->tempName,$file->baseName.'.'.$file->extension);
                //$fdb->url='uploads/' . $file->baseName . '.' . $file->extension;
                $fdb->save();//$file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }return true;
       // } else {return false;}
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
       // $url = Url::current(['lg'=>NULL], TRUE);
        $env = getenv("ENVIRONMENT");
       // $_FILES['ClaimRequest']['name']['imageFile']
       // if(isset($FILES["ClaimRequest"]["tmp_name"]['imageFile']) && $FILES["ClaimRequest"]["tmp_name"]['imageFile']){
            //@$filePath = realpath($FILES["ClaimRequest"]["tmp_name"]['imageFile']);
            $filePath=$F;
            //print_r($filePath);
            //print_r($FILES);exit;
           // @$typeArr = explode("/",$FILES["ClaimRequest"]["type"]['imageFile']);
            @$photo_name = "Doctracker_".rand(10,100)."_".$N;

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
                //$model->photo = $imageUrl;
            }else{
                return NULL;
            }
       // }
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Employee Code',
            'state_id' => 'Level',
            'visit_from' => 'Visit From *',
            'visit_to' => 'Visit To *',
            'mode' => 'Mode *',
            'date' => 'Date *',
            'amount' => 'Amount *',
            'amount2' => 'Fare *',
            'amount3' => 'Hotel Expenses *',
            'amount4' => 'Food *',
            'amount5' => 'Miscellaneous *',
            'amountinword' => 'Amount In Words *',
            'purpose' => 'Purpose *',
            'dc' => 'DO',
            'fund_agency' => 'Funding Agency *',
            'nature_service' => 'Nature of Services *',
            'ro_comment' => 'RO Comment *',
            'naturehead' => 'Natural Head*',
            'project_id' => 'Project',
            'project_budget_line_id' => 'Project Budget Line ID',
            'costcenter_id' => 'Costcenter',
            'program_id' => 'Program',
            'locationdescription_id' => 'Location Description ID',
            'ho_comment' => 'HO Comment',
            'tds' => 'TDS',
            'advance' => 'Advance',
            'net' => 'Net',
            'refnumber' => 'Ref Number',
            'refdate' => 'Ref Date',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'active' => 'Active',
            'imageFile'=>'Amount Bill Image',
            'imageFile2'=>'Fare Bill Image',
            'imageFile3'=>'Hotel Expenses',
            'imageFile4'=>'Food Expenses Image',
            'imageFile5'=>'Miscellaneous Bill Image',
        ];
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
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBudgetLine()
    {
        return $this->hasOne(ProjectBudgetLine::className(), ['id' => 'project_budget_line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostcenterSub()
    {
        return $this->hasOne(CostCentreSub::className(), ['id' => 'costcenter_id']); /// Cost Center Sub ID **//
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
    public function getLocationdescription()
    {
        return $this->hasOne(Locationdescription::className(), ['id' => 'locationdescription_id']);
    }

    public function getFundingAgency()
    {
        return $this->hasOne(FundingAgency::className(), ['id' => 'fund_agency']);
    }
}
