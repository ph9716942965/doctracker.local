<?php

namespace backend\controllers;

use Yii;
use backend\models\ExpenceTravel;
use backend\models\ExpenceTravelSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ExpenceTravelController implements the CRUD actions for ExpenceTravel model.
 */
class ExpenceTravelController extends BaseController
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
     * Lists all ExpenceTravel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpenceTravelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExpenceTravel model.
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
     * Creates a new ExpenceTravel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    public function actionCreate()
    {
        $model = new ExpenceTravel();
        $model->user_id=Authid($_SESSION['login_info']['username']);
        $model->status=Authstatus($_SESSION['login_info']['username']);
        $model->dc='0';
        if ($model->load(Yii::$app->request->post()) ) {
            $model->foodbill = UploadedFile::getInstance($model, 'foodbill');
            $model->taxibill = UploadedFile::getInstance($model, 'taxibill');
            $model->hotelbill =UploadedFile::getInstance($model, 'hotelbill');
            $model->tickets = UploadedFile::getInstance($model, 'tickets');
            $model->travelapproval = UploadedFile::getInstance($model, 'travelapproval');
            ////
            $model->foodbill->saveAs('uploads/' . $model->foodbill->baseName . '.' . $model->foodbill->extension);
            $file_name='uploads/' . $model->foodbill->baseName . '.' . $model->foodbill->extension;
            $model->foodbill =$file_name;
            ///////
            $model->taxibill->saveAs('uploads/' . $model->taxibill->baseName . '.' . $model->taxibill->extension);
            $file_name='uploads/' . $model->taxibill->baseName . '.' . $model->taxibill->extension;
            $model->taxibill =$file_name;
            ////
            $model->hotelbill->saveAs('uploads/' . $model->hotelbill->baseName . '.' . $model->hotelbill->extension);
            $file_name='uploads/' . $model->hotelbill->baseName . '.' . $model->hotelbill->extension;
            $model->hotelbill =$file_name;
            ////
            $model->tickets->saveAs('uploads/' . $model->tickets->baseName . '.' . $model->tickets->extension);
            $file_name='uploads/' . $model->tickets->baseName . '.' . $model->tickets->extension;
            $model->tickets =$file_name;
            ////
            $model->travelapproval->saveAs('uploads/' . $model->travelapproval->baseName . '.' . $model->travelapproval->extension);
            $file_name='uploads/' . $model->travelapproval->baseName . '.' . $model->travelapproval->extension;
            $model->travelapproval =$file_name;
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
     * Updates an existing ExpenceTravel model.
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
     * Deletes an existing ExpenceTravel model.
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
     * Finds the ExpenceTravel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExpenceTravel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExpenceTravel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
