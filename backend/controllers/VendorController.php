<?php

namespace backend\controllers;

use Yii;
use backend\models\Vendor;
use backend\models\VendorContactPerson;
use backend\models\VendorSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VendorController implements the CRUD actions for Vendor model.
 */
class VendorController extends BaseController {

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
     * Lists all Vendor models.
     *
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vendor model.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vendor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate() {
        $model = new Vendor();

        // display_array(var_dump(Yii::$app->request->post()));
        // exit;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (isset($_POST['VendorContactPerson']) && !empty($_POST['VendorContactPerson'])) {
                $this->vendorContactPerson($_POST['VendorContactPerson'], $model->id);
            }


            \Yii::$app->session->setFlash('success', 'Form save successfully');
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function vendorContactPerson($data, $id) {
        foreach ($data as $value) {
            if (isset($value['vendor_person_contact_id']) && $value['vendor_person_contact_id'] != '') {
                $vcpM = VendorContactPerson::find()->where(['id' => $value['vendor_person_contact_id']])->one();
            } else {
                $vcpM = new VendorContactPerson();
            }
            $vcpM->vendor_id = $id;
            $vcpM->name = $value['name'];
            $vcpM->title = $value['title'];
            $vcpM->address = $value['address'];
            $vcpM->contact_no = $value['contact_no'];
            $vcpM->pan_no = $value['pan_no'];
            $vcpM->service_tax_no = $value['service_tax_no'];
            $vcpM->email_id = $value['email_id'];
            $vcpM->save();
        }
    }

    /**
     * Updates an existing Vendor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        
        $vendorContactPersonM = VendorContactPerson::find()->where(['vendor_id' => $id])->andWhere(['status' => 1])->asArray()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (isset($_POST['VendorContactPerson']) && !empty($_POST['VendorContactPerson'])) {
                $this->vendorContactPerson($_POST['VendorContactPerson'], $model->id);
            }

            \Yii::$app->session->setFlash('success', 'Form updated successfully');
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'vendorContactPersonM' => $vendorContactPersonM,
        ]);
    }

    /**
     * Deletes an existing Vendor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            \Yii::$app->session->setFlash('success', 'Record deleted successfully');

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
     * Finds the Vendor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Vendor the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Vendor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeleteVendorContact() {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $vendorContact = VendorContactPerson::find()->where(['id' => $_GET['id']])->andWhere(['status' => 1])->one();
            $vendorContact->updated_at = date('Y-m-d H:i:s');
            $vendorContact->status = 0;
            if ($vendorContact->save(false)) {
                $return = [
                    'success' => true,
                    'status' => 200,
                    'message' => 'SUCCESSFULLY DELETE',
                ];
            }
        } else {
            $return = [
                'success' => false,
                'status' => 400,
                'message' => 'Got error while delete',
            ];
        }

        return json_encode($return);
    }

}
