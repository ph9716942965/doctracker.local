<?php

namespace backend\controllers;


use Yii;
use backend\models\UserLevels;
use backend\models\UserLevelsSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PageAuthentications;

/**
 * UserLevelsController implements the CRUD actions for UserLevels model.
 */
class UserLevelsController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
                ],
            ],
        ];
    }

    
    
            
    /**
     * Lists all UserLevels models.
     * @return mixed
     */
    public function actionIndex()
    {
        checkAuthentication($this);
        $searchModel = new UserLevelsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserLevels model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserLevels model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        checkAuthentication($this);
        $model = new UserLevels();

        if (isset($_POST['UserLevels'])) {
            
            $model->load($_POST);
            if($model->save())
            {
                
                $this->saveAuthentications($model);
                
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
    function saveAuthentications($model)
    {
        $postPageAuthentications = $_POST['PageAuthentication'];
//        display_array($postPageAuthentications);exit;
        $savedIds = [];
        for($i=0;$i<count($postPageAuthentications);$i++)
        {
            $singlePostPageAuthentication = $postPageAuthentications[$i];



            if(isset($singlePostPageAuthentication['authentication']))
            {
                for($j=0;$j<count($singlePostPageAuthentication['authentication']);$j++)
                {       
                    $pageAuthentication = new PageAuthentications();
                    $existingPageAuthentication = PageAuthentications::find()->where(['authentication'=>$singlePostPageAuthentication['authentication'][$j],'level_id'=>$model->id])->one();
                    if($existingPageAuthentication!=null)
                    {
                        $pageAuthentication = $existingPageAuthentication;
                    }

//                            display_array($pageAuthentication);

                    $pageAuthentication->authentication = $singlePostPageAuthentication['authentication'][$j];
                    if(isset($singlePostPageAuthentication['approve_of']) && in_array($singlePostPageAuthentication['authentication'][$j], $singlePostPageAuthentication['approve_of']))
                    {
//                        display_array($_POST);
//                        exit;
                        $pageAuthentication->approve_to = $singlePostPageAuthentication['approve_to'];
                        if(isset($singlePostPageAuthentication['notify_to']))
                        {
                            $pageAuthentication->notify_to = json_encode($singlePostPageAuthentication['notify_to']);
                        }
                        else
                        {
                            $pageAuthentication->notify_to = "[]";
                        }
                    }
                    else
                    {
                        $pageAuthentication->approve_to = "";
                        $pageAuthentication->notify_to = "[]";
                    }
                    
                    $pageAuthentication->level_id = $model->id;
                    
                    
                    $pageAuthentication->save();
                    
                    
//                    display_array($pageAuthentication)s
                    
                    $savedIds[] = $pageAuthentication->id;

//                            display_array($savedIds);
                }
            }




        }

        $deletingModel = PageAuthentications::find()->where(['not in','id',$savedIds])->andWhere(['level_id'=>$model->id])->all();
        for($de = 0;$de<count($deletingModel);$de++)
        {
            $deletingModel[$de]->delete();
        }

    }
    
    /**
     * Updates an existing UserLevels model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        checkAuthentication($this);
        $model = $this->findModel($id);

        if (isset($_POST['UserLevels'])) {
            
            $model->load($_POST);
            if($model->save())
            {
                
                $this->saveAuthentications($model);

                return $this->redirect(['index', 'id' => $model->id]);    
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserLevels model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        checkAuthentication($this);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserLevels model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserLevels the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserLevels::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
