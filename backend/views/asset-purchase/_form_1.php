<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AssetPurchase */
/* @var $form yii\widgets\ActiveForm */
$disabled = true;
//if ($model->errors) {
//    display_array($model->errors);
//}
?>

<div class="asset-purchase-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?php
    if (Yii::$app->user->identity->level_id >= backend\models\Level::RO) {
        $disabled = false;
        ?>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'ro_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Ro::find()->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select', 'disabled' => $disabled]); ?>
                        <?= $form->field($model, 'purpose')->textInput(['maxlength' => true]); ?>
                        <?= $form->field($model, 'vendor_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Vendor::find()->where(['status' => 1])->all(), 'id', 'name_unit'), ['prompt' => 'Select']); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'asset_category_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\AssetCategory::find()->where(['status' => 1])->all(), 'id', 'name'), ['prompt' => 'Select']); ?>
                        <?= $form->field($model, 'members_of_purchase_committee')->textInput(['maxlength' => true]); ?>
                        <?= $form->field($model, 'amount')->textInput(); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
                        <?= $form->field($model, 'date')->textInput(['class' => 'form-control datePicker']); ?>
                        <?= $form->field($model, 'project_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Project::find()->where(['status' => 1])->all(), 'id', 'name'), ['prompt' => 'Select']); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div style="border:1px dotted darkblue;padding: 10px">

                            <?php
                            if ($model->file_purchase_request_apporval != NULL || $model->file_purchase_request_apporval != "") {
                                echo $form->field($model, 'file_purchase_request_apporval')->fileInput();
                            } else {
                                echo $form->field($model, 'file_purchase_request_apporval')->fileInput();
                            }
                            ?>


                            <label for=""><?= $model->getAttributeLabel('file_purchase_request_apporval'); ?></label>
                            <!--<input type="file" name="AssetPurchase[file_purchase_request_apporval]"  >-->
                            <?php if ($model->isNewRecord == false) {
                                ?>
                                <input type="hidden" name="AssetPurchase[file_purchase_request_apporval]" value="<?php echo $model->file_purchase_request_apporval; ?>" >
                                <br/>
                                <?php if (!empty($model->file_purchase_request_apporval)) {
                                    ?>
                                    <a title="Download" href="<?php echo $model->file_purchase_request_apporval; ?>"><img src="<?php echo $model->file_purchase_request_apporval; ?>" height="70" width="70" ></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!--<br><br>-->
                        <div style="border:1px dotted darkblue;padding: 10px">
                            <label for=""><?= $model->getAttributeLabel('file_purchase_order'); ?></label>
                            <input type="file" name="AssetPurchase[file_purchase_order]"  >
                            <?php if ($model->isNewRecord == false) {
                                ?>
                                <input type="hidden" name="AssetPurchase[file_purchase_order]" value="<?php echo $model->file_purchase_order; ?>" >
                                <br/>
                                <?php if (!empty($model->file_purchase_order)) {
                                    ?>
                                    <a title="Download" href="<?php echo $model->file_purchase_order; ?>"><img src="<?php echo $model->file_purchase_order; ?>" height="70" width="70" ></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="border:1px dotted darkblue;padding: 10px">
                            <label for=""><?= $model->getAttributeLabel('file_quotation'); ?></label>
                            <input type="file" name="AssetPurchase[file_quotation]"  >
                            <?php if ($model->isNewRecord == false) {
                                ?>
                                <input type="hidden" name="AssetPurchase[file_quotation]" value="<?php echo $model->file_quotation; ?>" >
                                <br/>
                                <?php if (!empty($model->file_quotation)) {
                                    ?>
                                    <a title="Download" href="<?php echo $model->file_quotation; ?>"><img src="<?php echo $model->file_quotation; ?>" height="70" width="70" ></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!--<br><br>-->
                        <div style="border:1px dotted darkblue;padding: 10px">
                            <label for=""><?= $model->getAttributeLabel('file_pro_forma_final_invoice'); ?></label>
                            <input type="file" name="AssetPurchase[file_pro_forma_final_invoice]"  >
                            <?php if ($model->isNewRecord == false) {
                                ?>
                                <input type="hidden" name="AssetPurchase[file_pro_forma_final_invoice]" value="<?php echo $model->file_pro_forma_final_invoice; ?>" >
                                <br/>
                                <?php if (!empty($model->file_pro_forma_final_invoice)) {
                                    ?>
                                    <a title="Download" href="<?php echo $model->file_pro_forma_final_invoice; ?>"><img src="<?php echo $model->file_pro_forma_final_invoice; ?>" height="70" width="70" ></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="border:1px dotted darkblue;padding: 10px">
                            <label for=""><?= $model->getAttributeLabel('file_purchase_commite'); ?></label>
                            <input type="file" name="AssetPurchase[file_purchase_commite]"  >
                            <?php if ($model->isNewRecord == false) {
                                ?>
                                <input type="hidden" name="AssetPurchase[file_purchase_commite]" value="<?php echo $model->file_purchase_commite; ?>" >
                                <br/>
                                <?php if (!empty($model->file_purchase_commite)) {
                                    ?>
                                    <a title="Download" href="<?php echo $model->file_purchase_commite; ?>"><img src="<?php echo $model->file_purchase_commite; ?>" height="70" width="70" ></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
    <?php
    if (Yii::$app->user->identity->level_id >= backend\models\Level::HO) {
        ?>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'natural_head')->textInput(['maxlength' => true]); ?>
                        <?= $form->field($model, 'funding_agency_bu_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\FundingAgencyBu::find()->select(['id', 'code'])->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select']); ?>
                        <?= $form->field($model, 'lo')->textInput(['maxlength' => true]); ?>

                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'program_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Program::find()->select(['id', 'code'])->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select']); ?>
                        <?= $form->field($model, 'cost_centre_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\CostCentre::find()->select(['id', 'code'])->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select']); ?>
                        <?= $form->field($model, 'ho_comment')->textInput(['maxlength' => true]); ?>

                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'funding_agency_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\FundingAgency::find()->select(['id', 'code'])->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select']); ?>

                        <?= $form->field($model, 'cost_centre_sub_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\CostCentreSub::find()->select(['id', 'code'])->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select']); ?>


                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
    <?php
    if (backend\models\Level::ACCOUNTS == Yii::$app->user->identity->level_id) {
        ?>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'ref_number')->textInput(['maxlength' => true]); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'ref_date')->textInput(["class" => "form-control datePicker"]); ?>

                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'ac_comment')->textarea(['rows' => 2]); ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>









    <?php
    if ($model->isNewRecord) {
        $model->user_id = backend\models\User::getSessionUserId();
        echo $form->field($model, 'user_id')->hiddenInput()->label(false);
    }
    ?>    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
