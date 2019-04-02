<?php

namespace backend\controllers;

use Yii;
use backend\models\Vendorpayment;
use backend\models\VendorpaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; 
use backend\models\CostCentreSub;
use backend\models\FundingAgencyBu;
/**
 * VendorpaymentController implements the CRUD actions for Vendorpayment model.
 */
class VendorpaymentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vendorpayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendorpaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vendorpayment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vendorpayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vendorpayment();
        $model->user_id=Authid($_SESSION['login_info']['username']);
        $model->status_id=Authstatus($_SESSION['login_info']['username']);
        if ($model->load(Yii::$app->request->post())){
            $model->imageFile=UploadedFile::getInstances($model, 'imageFile');
            @$model->imageFile2=UploadedFile::getInstances($model, 'imageFile2');
            @$img1=$model->imageFile;
            @$img2=$model->imageFile2;
            if($model->upload()){
                if($model->save()){
                    $this->approve_status($model->getPrimaryKey());
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }else{
            echo "<pre>";print_r($model->getErrors());print_r($model);exit;
        }
        }
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vendorpayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->imgvalid='update';
        if ($model->load(Yii::$app->request->post())) {

             if(!empty($_FILES['VendorPayment']['name']['imageFile'])){
                // echo "<pre>";print_r($_FILES);exit;
                @$model->imageFile = UploadedFile::getInstances($model, 'imageFile');
                $model->upload($model->upload_approval,true,'upload_approval');
               // echo "<pre>";print_r($_FILES);exit;
            }
            if(!empty($_FILES['VendorPayment']['name']['imageFile2'])){
                @$model->imageFile2 = UploadedFile::getInstances($model, 'imageFile2');
                $model->upload($model->upload_bill,true,'upload_bill');
            }
            if ($model->validate()){
                if($model->save()){
                    $this->approve_status($model->id);
                    \Yii::$app->session->setFlash('success', 'vendor payment save successfully');
                    $searchModel = new VendorpaymentSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                   // return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else{
               //echo "error 122<pre>";print_r($model);print_r($model->getErrors());exit;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vendorpayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionReturn(){
    }

    /**
     * Finds the Vendorpayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vendorpayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendorpayment::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function imageUplodeOns3($F,$N){
         $env = getenv("ENVIRONMENT");
        $filePath=$F;
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
             }else{
                 return NULL;
             }
     }

    private function s3DeleteImages($imgURL) {
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

    private function approve_status($id, $approve = true) {
        $model = $this->findModel($id);    
        $model->status_id = Authstatus($_SESSION['login_info']['username']);
        $model->imgvalid = 'update';
       // $model->reject = 'reject';
        if ($model->save()) {
           // Yii::$app->getDb()->createCommand()->insert('claim_request_log', ['request_id' => $id,'status_id'=>$model->state_id])->execute();
            if ($approve) {
                $model->status_id++;
                Yii::$app->getDb()->createCommand()->insert('vendor_payment_log', ['request_id' => $id,'status_id'=>$model->status_id])->execute();
                //$model->state_id++;
                $model->save();
                // print_r( $model->state_id);
            } else {
                $model->status_id--;
                Yii::$app->getDb()->createCommand()->insert('vendor_payment_log', ['request_id' => $id,'status_id'=>$model->status_id])->execute();
               $model->save();
            }
        } else {
            print_r($model->getErrors());
        }
        // exit;
    }


     public function actionAjax(){
         if(isset($_REQUEST['jsfabi'])){
            return json_encode(FundingAgencyBu::find()->select(["id","name as text"])->where(["funding_agency_id"=>$_REQUEST['jsfabi']])->asArray()->all());
     
         }else{
            return json_encode(CostCentreSub::find()->select(["id","name as text"])->asArray()->all());

         }
     }
}
