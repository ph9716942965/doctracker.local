<?php

namespace backend\controllers;

use Yii;
use backend\models\Ro;
use backend\models\RoSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoController implements the CRUD actions for Ro model.
 */
class RoController extends BaseController {

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
     * Lists all Ro models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ro model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Ro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//create RO user for login
            $this->createUser($model);

            \Yii::$app->session->setFlash('success', 'Form save successfully');

            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $olddata = isset($model->oldAttributes['email_id']) ? $model->oldAttributes['email_id'] : 1;
            if ($model->save()) {
                if ($model->email_id != $olddata) {
                    $user = \backend\models\User::find()->where(["`user`.level_id" => \backend\models\Level::RO])->andWhere(["email" => $olddata])->one();
                    $user->email = $model->email_id;
                    $user->save(false);
                }
                \Yii::$app->session->setFlash('success', 'Form updated successfully');
            } else {
                Yii::$app->session->setFlash('error', "Form not saved.");
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }


        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ro model.
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

    /**
     * Finds the Ro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Ro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function createUser($model) {
        if (!empty($model->email_id)) {

            $result = \backend\models\User::find()
                    ->where(["`user`.level_id" => \backend\models\Level::RO])
                    ->orderBy(["`user`.id" => SORT_DESC])
                    ->limit(1)
                    ->one();
            if (!empty($result)) {
                $getSerial = substr($result['username'], -4);
                $valueAdd = "0001";
                $addedSerial = $getSerial + $valueAdd;
                $finalSerial = sprintf("%04d", $addedSerial);
                $finalCode = "RO" . $finalSerial;
            } else {
                $finalCode = "RO0001";
            }
            $user = new \common\models\User();
            $user->username = $finalCode;
            $user->email = $model->email_id;
            $user->profile_id = $model->id;
            $user->level_id = \backend\models\Level::RO;
            $password = \backend\models\User::roPassword();
            $user->setPassword($password);
            $user->auth_key = md5($finalCode);
            if ($user->save()) {
                Yii::$app->mailer->compose('register', ['model' => $user, "password" => $password])
                        ->setFrom(['reachus@dhwaniris.com' => 'Doctracker'])
                        ->setTo($model->email_id)
                        ->setSubject("Welcome to Doctracker")
                        ->send();
            }
        }
    }

}
