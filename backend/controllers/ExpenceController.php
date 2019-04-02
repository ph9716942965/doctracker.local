<?php

namespace backend\controllers;

use Yii;
//use backend\models\Expence;
use backend\models\Expence;
use backend\models\ExpenceSearch;
//use backend\models\ExpenceSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ExpenceController implements the CRUD actions for Expence model.
 */
class ExpenceController extends BaseController
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
     * Lists all Expence models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$searchModel = new ExpenceSearch();
        $searchModel = new ExpenceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expence model.
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
     * Creates a new Expence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expence();
       // echo 
        $model->user_id=Authid($_SESSION['login_info']['username']);
        $model->status=Authstatus($_SESSION['login_info']['username']);
        $model->dc='0';

        if ($model->load(Yii::$app->request->post()) ) {
            $model->upload = UploadedFile::getInstance($model, 'upload');
            $model->upload->saveAs('uploads/' . $model->upload->baseName . '.' . $model->upload->extension);
            $file_name='uploads/' . $model->upload->baseName . '.' . $model->upload->extension;
            $model->upload =$file_name;
            //$filePath=Yii::$app->getBasePath().'/web/'.$model->upload;
           // $model->upload=  Yii::$app->s3->upload($filePath);
            if($model->save()){
                // echo "<pre>"; print_r($model);exit;
                 return $this->redirect(['index']);
             }else{
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Expence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Expence model.
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

    /**
     * Finds the Expence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expence::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
