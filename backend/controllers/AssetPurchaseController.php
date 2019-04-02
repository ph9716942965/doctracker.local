<?php

namespace backend\controllers;

use Yii;
use backend\models\AssetPurchase;
use backend\models\AssetPurchaseSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AssetPurchaseController implements the CRUD actions for AssetPurchase model.
 */
class AssetPurchaseController extends BaseController {

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
     * Lists all AssetPurchase models.
     *
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AssetPurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssetPurchase model.
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
     * Creates a new AssetPurchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate() {
        $post = Yii::$app->request->post();
        $model = new AssetPurchase();
        if (isset($post['AssetPurchase']['date']) && $post['AssetPurchase']['date'] != '') {
            $post['AssetPurchase']['date'] = date('Y-m-d', strtotime($post['AssetPurchase']['date']));
        }

        if ($model->load($post)) {
            $model->file_purchase_request_apporval = UploadedFile::getInstance($model, 'file_purchase_request_apporval');
            $model->file_quotation = UploadedFile::getInstance($model, 'file_quotation');
            $model->file_purchase_commite = UploadedFile::getInstance($model, 'file_purchase_commite');
            $model->file_purchase_order = UploadedFile::getInstance($model, 'file_purchase_order');
            $model->file_pro_forma_final_invoice = UploadedFile::getInstance($model, 'file_pro_forma_final_invoice');
            $model->uploadImage($model, ['file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice']);

            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Form save successfully');

                return $this->redirect(['index', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing AssetPurchase model.
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
        $file_purchase_request_apporval_Old = $model->file_purchase_request_apporval;
        $file_purchase_order_Old = $model->file_purchase_order;
        $file_quotation_Old = $model->file_quotation;
        $file_pro_forma_final_invoice_Old = $model->file_pro_forma_final_invoice;
        $file_purchase_commite_Old = $model->file_purchase_commite;
        if ($model->load(Yii::$app->request->post())) {
            if (!empty($_FILES['AssetPurchase']['name']['file_purchase_request_apporval'])) {
                $model->file_purchase_request_apporval = UploadedFile::getInstance($model, 'file_purchase_request_apporval');
                $model->uploadImage($model, ['file_purchase_request_apporval']);
                if ($file_purchase_request_apporval_Old != '') {
                    $model->s3DeleteImages($file_purchase_request_apporval_Old);
                }
            }
            if (!empty($_FILES['AssetPurchase']['name']['file_purchase_order'])) {
                $model->file_purchase_order = UploadedFile::getInstance($model, 'file_purchase_order');
                $model->uploadImage($model, ['file_purchase_order']);
                if ($file_purchase_order_Old != '') {
                    $model->s3DeleteImages($file_purchase_order_Old);
                }
            }
            if (!empty($_FILES['AssetPurchase']['name']['file_quotation'])) {
                $model->file_quotation = UploadedFile::getInstance($model, 'file_quotation');
                $model->uploadImage($model, ['file_quotation']);
                if ($file_quotation_Old != '') {
                    $model->s3DeleteImages($file_quotation_Old);
                }
            }
            if (!empty($_FILES['AssetPurchase']['name']['file_pro_forma_final_invoice'])) {
                $model->file_pro_forma_final_invoice = UploadedFile::getInstance($model, 'file_pro_forma_final_invoice');
                $model->uploadImage($model, ['file_pro_forma_final_invoice']);
                if ($file_pro_forma_final_invoice_Old != '') {
                    $model->s3DeleteImages($file_pro_forma_final_invoice_Old);
                }
            }
            if (!empty($_FILES['AssetPurchase']['name']['file_purchase_commite'])) {
                $model->file_purchase_commite = UploadedFile::getInstance($model, 'file_purchase_commite');
                $model->uploadImage($model, ['file_purchase_commite']);
                if ($file_purchase_commite_Old != '') {
                    $model->s3DeleteImages($file_purchase_commite_Old);
                }
            }
            // $model->file_purchase_request_apporval;
            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Form updated successfully');
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }
        $model->scenario = 'update';
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AssetPurchase model.
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
     * Finds the AssetPurchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return AssetPurchase the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AssetPurchase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
