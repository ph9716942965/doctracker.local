<?php

namespace backend\controllers;

use Yii;
use backend\models\ClaimRequest;
use backend\models\ClaimRequestSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Upload;
use yii\helpers\Json;
use backend\models\ProjectBudgetLine;
use backend\models\CostCentreSub;
//use yii\helpers\Url;

/**
 * ClaimRequestController implements the CRUD actions for ClaimRequest model.
 */
class ClaimRequestController extends BaseController {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all ClaimRequest models.
     * @return mixed
     */
    public function actionIndex() {
        //echo "<pre>";print_r(Rstatus(5));exit;
        $searchModel = new ClaimRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // echo "<pre>";print_r($searchModel);exit;
        //echo "47<pre>";print_r($dataProvider);exit;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClaimRequest model.
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
     * Creates a new ClaimRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
    **/
    
    public function actionCreatetravel() {
        $model = new ClaimRequest();
        //$model = new Request();
        $file=new Upload();
        $model->request_type='Travel Expenses';
        $model->user_id=Authid($_SESSION['login_info']['username']);
        $model->state_id=Authstatus($_SESSION['login_info']['username']);
        if ($model->load(Yii::$app->request->post())){
            $model->date=date("Y-m-d", strtotime($model->date));
            $model->imageFile5=UploadedFile::getInstances($model, 'imageFile5');
            $model->imageFile4=UploadedFile::getInstances($model, 'imageFile4');
            $model->imageFile3=UploadedFile::getInstances($model, 'imageFile3');
            $model->imageFile2=UploadedFile::getInstances($model, 'imageFile2');
            $model->imageFile =UploadedFile::getInstances($model, 'imageFile');
           if($model->save()){
               if($model->state_id>2){ @$this->DC_Create($model->getPrimaryKey());}
            $this->approve_status($model->getPrimaryKey());
            if ($model->upload($model->getPrimaryKey())) {
                $model->upload2($model->getPrimaryKey());
                $model->upload3($model->getPrimaryKey());
                $model->upload4($model->getPrimaryKey());
                $model->upload5($model->getPrimaryKey());
                //echo 'successfull upload line number80';exit;
                // echo "<pre>";print_r($searchModel);exit;
                \Yii::$app->session->setFlash('success', 'Form save successfully');
                $searchModel=new ClaimRequestSearch();
                return $this->render('index', [
                    'searchModel' => new ClaimRequestSearch(),
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                ]);
               // return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }
        return $this->render('createtravel', ['model' => $model,]);
    }
    
	
    public function actionCreateother() {
        $model = new ClaimRequest();
        $file=new Upload();
        $model->request_type='Other Expenses';
        $model->user_id=Authid($_SESSION['login_info']['username']);
        $model->state_id=Authstatus($_SESSION['login_info']['username']);
        $model->visit_from=$model->visit_to=$model->mode='NA';$model->amount2=$model->amount3=$model->amount4=$model->amount5=0;
        if ($model->load(Yii::$app->request->post())){
           // $model->date=date("Y-m-d", strtotime($model->date));
            $model->imageFile5=$model->imageFile4=$model->imageFile3=$model->imageFile2= $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
            if($model->save()){
            $this->approve_status($model->getPrimaryKey());
             if($model->state_id>2){ @$this->DC_Create($model->getPrimaryKey());}
            //$this->approve_status($model->getPrimaryKey());
            if ($model->upload($model->getPrimaryKey())) {
                
                \Yii::$app->session->setFlash('success', 'Form save successfully');
                //echo 'successfull upload line number 113';exit;
                $searchModel=new ClaimRequestSearch();
                return $this->render('index', [
                    'searchModel' => new ClaimRequestSearch(),
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                ]);
                //return $this->redirect(['view', 'id' => $model->id]);
            }
           }
        }
        return $this->render('createother', ['model' => $model,]);
    }

    public function actionCreate() {
        $model = new ClaimRequest();
        //$model = new Request();
        $file = new Upload();
        $model->request_type = 'Local Conveyance';
        $model->user_id = Authid($_SESSION['login_info']['username']);
        $model->state_id = Authstatus($_SESSION['login_info']['username']);
        $model->amount2 = $model->amount3 = $model->amount4 = $model->amount5 = 0;
        if ($model->load(Yii::$app->request->post())) {
            $model->date = date("Y-m-d", strtotime($model->date));//2019-01-07
            //echo "<pre>145";print_r($model->date);exit;
            $model->imageFile5 = $model->imageFile4 = $model->imageFile3 = $model->imageFile2 = $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
            /* if($_FILES['ClaimRequest']['name']['imageFile']){
              //echo "<pre>"; print_r($_FILES);
              $r=$this->imageUplodeOnS3($_FILES,$model);
              echo "142<pre>";print_r($r);exit;
              } */

            // $r=$this->imageUplodeOnS3(UploadedFile::getInstances($model, 'imageFile'),$model);
            // $model->imageFile2=UploadedFile::getInstances($model, 'imageFile');
           if($model->save()){
               
               $this->approve_status($model->getPrimaryKey());
              // echo "<pre>";print_r($model->state_id);exit;
               if($model->state_id>2){ @$this->DC_Create($model->getPrimaryKey());}
            if ($model->upload($model->getPrimaryKey())) {
                //echo 'successfull upload line number 79';exit;
                \Yii::$app->session->setFlash('success', 'Form save successfully');
                $searchModel=new ClaimRequestSearch();
                return $this->render('index', [
                    'searchModel' => new ClaimRequestSearch(),
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                ]);
               // return $this->redirect(['view', 'id' => $model->id]);
            }
        }
		}
        return $this->render('create', [
                    'model' => $model,
        ]);
    }
    
    /**
     * Updates an existing ClaimRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatetravel($id) {
        $model = $this->findModel($id);
        $model->imgvalid='update';
        $model->date=date("d-m-Y", strtotime($model->date));
       // $model->request_type=' Expenses';
       // $model->user_id=Authid($_SESSION['login_info']['username']);
       /* $connection = Yii::$app->getDb();
        $command = $connection->createCommand('select * from upload where request_id='.$model->id);
        $images=$command->queryAll();*/
        $images= \backend\models\Upload::find()->where(["request_id"=>$model->id])->asArray()->all();
    
        if($images[0]){ $model->imageFile=$images[0]['url']; }
        if($images[1]){ $model->imageFile2=$images[1]['url']; }
        if($images[2]){ $model->imageFile3=$images[2]['url']; }
        if($images[3]){ $model->imageFile4=$images[3]['url']; }
        if($images[4]){ $model->imageFile5=$images[4]['url']; }
        //$model->state_id=Authstatus($_SESSION['login_info']['username']);
        //$model->visit_from=$model->visit_to=$model->mode='NA';$model->amount2=$model->amount3=$model->amount4=$model->amount5=0;
        if ($model->load(Yii::$app->request->post())){
            //[imageFile][]
            if(!empty($_FILES['ClaimRequest']['name']['imageFile'])){
                $file=new Upload();
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
                $model->upload($images[0]['id'],$images[0]['url']);
            }
            if(!empty($_FILES['ClaimRequest']['name']['imageFile2'])){
                $file=new Upload();
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile2');
                $model->upload($images[1]['id'],$images[1]['url']);
            }
            if(!empty($_FILES['ClaimRequest']['name']['imageFile3'])){
                $file=new Upload();
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile3');
                $model->upload($images[2]['id'],$images[2]['url']);
            }if(!empty($_FILES['ClaimRequest']['name']['imageFile4'])){
                $file=new Upload();
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile4');
                $model->upload($images[3]['id'],$images[3]['url']);
            }if(!empty($_FILES['ClaimRequest']['name']['imageFile5'])){
                $file=new Upload();
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile5');
                $model->upload($images[4]['id'],$images[4]['url']);
            }
          
            $model->date=date("Y-m-d", strtotime($model->date));
            $model->imageFile5=$model->imageFile4=$model->imageFile3=$model->imageFile2= $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
           // $model->imageFile5=$model->imageFile4=$model->imageFile3=$model->imageFile2= $model->imageFile = file_get_contents('https://tineye.com/images/widgets/mona.jpg');
           if($model->save()){
            $this->approve_status($id);
            if($model->state_id>2){ @$this->DC_Create($id);}
           // @$this->DC_Create($id);
            \Yii::$app->session->setFlash('success', 'Form save successfully');
            $searchModel=new ClaimRequestSearch();
            return $this->render('index', [
                'searchModel' => new ClaimRequestSearch(),
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
            ]);
            //if ($model->upload($model->getPrimaryKey())) {
                //echo 'successfull upload line number 113';exit;
                //return $this->redirect(['view', 'id' => $model->id]);
                //}
            }
        }
        return $this->render('updatetravel', [
                    'model' => $model,
        ]);
    }

    function actionReturn() {
        if (isset($_REQUEST['id']) && isset($_REQUEST['ac_comment'])) {
            Yii::$app->getDb()->createCommand()->update('claim_request', ['ac_comment' => $_REQUEST['ac_comment'],], ['id' => $_REQUEST['id']])->execute();
            $this->approve_status($_REQUEST['id'], false);
            echo "success";
        }elseif (isset($_REQUEST['ho_comment2'])) {
            Yii::$app->getDb()->createCommand()->update('claim_request', ['ho_comment' => $_REQUEST['ho_comment2'],'state_id'=>3], ['id' => $_REQUEST['id']])->execute();
            Yii::$app->getDb()->createCommand()->update('claim_request', ['state_id'=>1], ['id' => $_REQUEST['id']])->execute();   
            Yii::$app->getDb()->createCommand()->insert('claim_request_log', ['request_id' => $_REQUEST['id'],'status_id'=>1])->execute();
            //$this->approve_status($_REQUEST['id'], false);
            echo "success";
            return true;
        }elseif (isset($_REQUEST['ho_comment'])) {
            Yii::$app->getDb()->createCommand()->update('claim_request', ['ho_comment' => $_REQUEST['ho_comment'],'state_id'=>3], ['id' => $_REQUEST['id']])->execute();
            Yii::$app->getDb()->createCommand()->update('claim_request', ['state_id'=>2], ['id' => $_REQUEST['id']])->execute();   
            $this->approve_status($_REQUEST['id'], false);
           
            echo "success";return true;
        }elseif (isset($_REQUEST['ro_comment'])) {
            Yii::$app->getDb()->createCommand()->update('claim_request', ['ro_comment' => $_REQUEST['ro_comment'],
                'state_id' => (Authstatus($_SESSION['login_info']['username']))], ['id' => $_REQUEST['id']])->execute();
            $this->approve_status($_REQUEST['id'], false);
            echo "success";
        }else{
            echo "FAIL";
        }
        
    }

    public function actionReturny($id) {

        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update ClaimRequest #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "ClaimRequest #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update ClaimRequest #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('view', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionUpdateother($id){
        $model = $this->findModel($id);
        $model->imgvalid='update';
        $model->request_type='Other Expenses';
        /*$connection = Yii::$app->getDb();
        $command = $connection->createCommand('select * from Upload where request_id='.$model->id);
        $images=$command->queryAll();*/
        $images= \backend\models\Upload::find()->where(["request_id"=>$model->id])->asArray()->all();
    
        if($images[0]){
            $model->imageFile=$images[0]['url'];
        }
        //Upload::find()->where(['request_id'=>$model->id])) !== null
        $model->date=date("d-m-Y", strtotime($model->date));

       // $model->user_id=Authid($_SESSION['login_info']['username']);
        //$model->state_id=Authstatus($_SESSION['login_info']['username']);
        $model->visit_from=$model->visit_to=$model->mode='NA';$model->amount2=$model->amount3=$model->amount4=$model->amount5=0;
        if ($model->load(Yii::$app->request->post())){
            if(!empty($_FILES['ClaimRequest']['name']['imageFile'])){
                $file=new Upload();
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
                $model->upload($images[0]['id'],$images[0]['url']);
            }
            $model->date=date("Y-m-d", strtotime($model->date));
            $model->imageFile5=$model->imageFile4=$model->imageFile3=$model->imageFile2= $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
           // $model->imageFile5=$model->imageFile4=$model->imageFile3=$model->imageFile2= $model->imageFile = file_get_contents('https://tineye.com/images/widgets/mona.jpg');
           if($model->save()){
              // echo "<pre>";'saved';exit;
            $this->approve_status($id);
            //$query=\backend\models\FundingAgency::find()->select("name")->where(["id"=>$id])->one();
            if($model->state_id>2){ @$this->DC_Create($id);}
           // @$this->DC_Create($id);
            //if ($model->upload($model->getPrimaryKey())) {
                //echo 'successfull upload line number 113';exit;
               // return $this->redirect(['view', 'id' => $model->id]);
               \Yii::$app->session->setFlash('success', 'Form save successfully');
               $searchModel=new ClaimRequestSearch();
               return $this->render('index', [
                   'searchModel' => new ClaimRequestSearch(),
                   'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
               ]);
            //}
           }  else{
          // echo "<pre>"; print_r($model->errors);exit;
           }
        } 
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->id]);
          }
         */
        return $this->render('updateother', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->imgvalid='update';
       /* $connection = Yii::$app->getDb();
        $command = $connection->createCommand('select * from upload where request_id='.$model->id);
        $images=$command->queryAll();*/
        $images= \backend\models\Upload::find()->where(["request_id"=>$model->id])->asArray()->all();
    
        if($images[0]){
            $model->imageFile=$images[0]['url'];
        }
        if ($model->load(Yii::$app->request->post())) {
            if(!empty($_FILES['ClaimRequest']['name']['imageFile'])){
                $file=new Upload();
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
                $model->upload($images[0]['id'],$images[0]['url']);
            }

           /* echo "405<pre>";
            echo($model->costcenter_id);exit;*/
        
            if($model->save()){
                $this->approve_status($id);
                //@$this->DC_Create($id);
                if($model->state_id>2){ @$this->DC_Create($id);}

                \Yii::$app->session->setFlash('success', 'Form save successfully');
                $searchModel=new ClaimRequestSearch();
                return $this->render('index', [
                    'searchModel' => new ClaimRequestSearch(),
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                ]);
                //if ($model->upload($model->getPrimaryKey())) {
                    //echo 'successfull upload line number 113';exit;
                    //return $this->redirect(['view', 'id' => $model->id]);
                    //}
                }else{
                    //echo "<pre>";print_r($model->errors);print_r(Yii::$app->request->post());exit;
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
           
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ClaimRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            \Yii::$app->session->setFlash('success', "Record deleted successfully");

            return $this->redirect(['index']);
        } catch (\yii\db\Exception $ex) {
            if ($ex->getCode() === 23000) {
                \Yii::$app->session->setFlash('warning', "Record couldn't delete due to Database Relation Restriction");
                return $this->redirect(['index']);
//                throw new \yii\web\HttpException(409, 'Relation Restriction');
            } else {
                throw $ex;
            }
        }
    }

    private function approve_status($id, $approve = true) {
        $model = $this->findModel($id);    
        $model->state_id = Authstatus($_SESSION['login_info']['username']);
        $model->imgvalid = 'update';
        $model->reject = 'reject';
        if ($model->save()) {
           // Yii::$app->getDb()->createCommand()->insert('claim_request_log', ['request_id' => $id,'status_id'=>$model->state_id])->execute();
            if ($approve) {
                Yii::$app->getDb()->createCommand()->insert('claim_request_log', ['request_id' => $id,'status_id'=>++$model->state_id])->execute();
                //$model->state_id++;
                $model->save();
                // print_r( $model->state_id);
            } else {
                $model->state_id--;
                Yii::$app->getDb()->createCommand()->insert('claim_request_log', ['request_id' => $id,'status_id'=>$model->state_id])->execute();
               $model->save();
            }
        }else {
           // print_r($model->getErrors());
        }
        // exit;
    }

    /**
     * Finds the ClaimRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClaimRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ClaimRequest::findOne($id)) !== null) {
            $model->date=date("d-m-Y", strtotime($model->date));
           // $model->date=date("d-m-Y", strtotime($model->date));
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionTest2($img = 'uploads/5bbee73f70d3c383691teach_profile (1).jpg') {
        $this->imageUplodeOns3($img);
    }
    public function actionFormdata() {

        /* $out= [['id'=>'1', 'name'=>'name1'],
          ['id'=>'2', 'name'=>'name2'] ]; */
        $ids = isset($_REQUEST['depdrop_parents']) ? $_REQUEST['depdrop_parents'] : 1;
        $ProjectBudgetLine = ProjectBudgetLine::find()->select('id,name')->where(['project_id' => $ids[0]])->asArray()->all();
        echo Json::encode(['output' => $ProjectBudgetLine, 'selected' => '']);
        return;
    }

    public function actionCostcenterformdata() {
        $ids = isset($_REQUEST['depdrop_parents']) ? $_REQUEST['depdrop_parents'] : 1;
        $CostCentreSub = CostCentreSub::find()->select('id,name')->where(['cost_centre_id' => $ids[0]])->asArray()->all();
        echo Json::encode(['output' => $CostCentreSub, 'selected' => '']);
        return;
    }

public function actionTest(){
    $this->DC_Create(73);
}

    private function DC_Create($ClaimR_id){
       // return true;
        $connection = Yii::$app->getDb();
       $command = $connection->createCommand('select dc from claim_request where id='.$ClaimR_id.' ');
        @$res=$command->queryAll()[0]['dc'];
      // echo $command->
      
      if(!$res){
        $command2 = $connection->createCommand("SELECT concat('DC-',MONTH(CURRENT_DATE()),'-',YEAR(CURRENT_DATE()))as pre");
        $com3=$connection->createCommand("select max(dc) as dc from claim_request");
       // $ex='DC-1-2019-1';
        $ex=$com3->queryAll();
        $ex=explode('-',$ex[0]['dc']);
           // echo "<pre>460";print_r($res);exit;
            $DC=$command2->queryAll()[0]['pre'].'-'.++$ex[3];
            $DC_GEN = $this->findModel($ClaimR_id);
            //echo "463<pre>";print_r($DC);
            $DC_GEN->dc=$DC;
           if($DC_GEN->save()){
           // echo " 666Updated";
           // print_r($DC_GEN);
           }else{
            $conn = Yii::$app->getDb();          
                $conn->createCommand()->update('claim_request', ['dc' =>$DC,], ['id' => $ClaimR_id,'dc'=>NULL])->execute();
            }
           //exit;
    }
    }
}
