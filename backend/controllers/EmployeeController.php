<?php

namespace backend\controllers;

use Yii;
use backend\models\Employee;
use backend\models\EmployeeSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends BaseController {

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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Employee();

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
     * Updates an existing Employee model.
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
                    $user = \backend\models\User::find()->where(["`user`.level_id" => \backend\models\Level::EMPLOYEE])->andWhere(["email" => $olddata])->one();
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
     * Deletes an existing Employee model.
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
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function createUser($model) {
        if (!empty($model->email_id)) {
            $result = \backend\models\User::find()
                    ->where(["`user`.level_id" => \backend\models\Level::EMPLOYEE])
                    ->orderBy(["`user`.id" => SORT_DESC])
                    ->limit(1)
                    ->one();
            $finalCode = "EM0001";
            if (!empty($result) && is_numeric(substr($result['username'], -4))) {
                $addedSerial = (int) substr($result['username'], -4) + 0001;
                $finalCode = "EM" . sprintf("%04d", $addedSerial);
            }
            $user = new \common\models\User();
            $user->username = $finalCode;
            $user->email = $model->email_id;
            $user->profile_id = $model->id;
            $user->level_id = \backend\models\Level::EMPLOYEE;
            $password = \backend\models\User::employeePassword();
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
