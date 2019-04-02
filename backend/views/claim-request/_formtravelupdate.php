<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Project;
$lu=$_SESSION['login_info']['username'];
$USERAUTH=new CheckAuth2($_SESSION['login_info']['username']);
/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-request-form">
<ul class="nav nav-tabs">
        <?php /*<li ><a class="custom-control-label" for="radio"  href="<?=Url::toRoute('claim-request/create')?>">Local Convence</a></li>
        <li class="active"><a class="custom-control-label" for="radio"  href="<?=Url::toRoute('claim-request/createtravel')?>">Travel Convence</a></li>
        */ ?><?php /*<li ><a class="custom-control-label" for="radio"  href="<?=Url::toRoute('claim-request/createother')?>">Other Convence</a></li>
*/?>
</ul>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
   
    <div class="row">
<div class="col-md-3">
    <div class="form-group field-claimrequest-user_id required">
	<label class="control-label" for="claimrequest-user_id">Employee Code</label>
	<input type="text" id="claimrequest-user_id" class="form-control"  value="<?= emp_name($model->user_id) ?>" readonly="true" >
	</div> 
</div>
       <?php /* <div class="col-md-3">
        <?= $form->field($model, 'user_id')->textInput(['readonly'=>true]) ?> 
        </div> */ ?>
		<div class="col-md-3">
        <div class="form-group field-claimrequest-user_id required">
		<label class="control-label" for="claimrequest-user_id">Expence Type</label>
		<input type="text" id="claimrequest-user_id" class="form-control"  value="Travel Expence" readonly="true" >

		
		</div> 
        </div>
        </div>
   
    
    <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'visit_from')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'visit_from')]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'visit_to')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'visit_to')]) ?> </div>
   <div class="col-md-3"> 
<?= ((readonly($model->id,$lu,'mode')!=true) || $model->isNewRecord)
        ?$form->field($model, 'mode')->DropdownList(['Auto'=>'Auto','Cab'=>'Cab','Other'=>'Other'])
        :$form->field($model, 'mode')->textInput(['readonly' => true]);
?>
 </div>
   
   <?php /*<div class="col-md-3">

   <?= $form->field($model, 'mode')->DropdownList(['Auto'=>'Auto','Cab'=>'Cab','Other'=>'Other'],['readonly'=>readonly($model->id,$_SESSION['login_info']['username'],'mode')]) ?>
   <?php // $form->field($model, 'mode')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?></div> */ ?>
   
   <div class="col-md-3"> 
<?= ((readonly($model->id,$lu,'wd')!=true) || $model->isNewRecord)
        ?$form->field($model, 'date')->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax ",'readonly'=>readonly($model->id,$lu,'wd'),'required'=>true])
        :$form->field($model, 'date')->textInput(['readonly' => true]);
?>
 </div>
   
   <?php // $form->field($model, 'date')->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax",'readonly'=>readonly($model->id,$lu,'mode'),'required'=>true]) ?>

   <?php
/* $form->field($model, 'date')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter date ...'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose'=>true,
        
    ]
]);*/

?><?php // $form->field($model, 'date')->textInput() ?>
   </div>
   
   <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'amount2')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode'),'type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'amount3')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode'),'type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"><?= $form->field($model, 'amount4')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode'),'type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'amount5')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode'),'type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   </div>

   <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'amount')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode'),'type' => 'number','min'=>0,'onkeyup'=>'ajaxamount2word()', 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'amountinword')->textInput(['maxlength' => true,'readonly'=>true]) ?> </div>
   <div class="col-md-6"><?= $form->field($model, 'purpose')->textarea(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?> </div>
   </div>
   <div class="row">
   <div class="col-md-4">
            <div style="border:1px dotted darkblue;padding: 10px">
            <?php 
			echo ($model->isNewRecord || $USERAUTH->Checkuser()=='EMP')?$form->field($model, 'imageFile[]')->fileInput(['multiple' => false, 'accept' => 'image/*']):"";
			?>
            <?php // $form->field($model, 'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php if ($model->isNewRecord == false) { ?>
                                <input type="hidden" name="ClaimRequest[imageFile]" value="<?php echo $model->imageFile; ?>" >
                                <br/>
                                <?php if (!empty($model->imageFile)) { ?>
                                    <a title="Download" href="<?php echo $model->imageFile; ?>"><img src="<?php echo $model->imageFile; ?>" height="70" width="70" ></a>
                <?php } } ?>
        </div>
    </div>
    <div class="col-md-4">
            <div style="border:1px dotted darkblue;padding: 10px">
            <?php 
			echo ($model->isNewRecord || $USERAUTH->Checkuser()=='EMP')?$form->field($model, 'imageFile2[]')->fileInput(['multiple' => false, 'accept' => 'image/*']):"";
			?>
            <?php // $form->field($model, 'imageFile2[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php if ($model->isNewRecord == false) { ?>
                                <input type="hidden" name="ClaimRequest[imageFile2]" value="<?php echo $model->imageFile2; ?>" >
                                <br/>
                                <?php if (!empty($model->imageFile2)) { ?>
                                    <a title="Download" href="<?php echo $model->imageFile2; ?>"><img src="<?php echo $model->imageFile2; ?>" height="70" width="70" ></a>
                <?php } } ?>
        </div>
    </div>
    <div class="col-md-4">
            <div style="border:1px dotted darkblue;padding: 10px">
            <?php 
			echo ($model->isNewRecord || $USERAUTH->Checkuser()=='EMP')?$form->field($model, 'imageFile3[]')->fileInput(['multiple' => false, 'accept' => 'image/*']):"";
			?>
            <?php // $form->field($model, 'imageFile3[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php if ($model->isNewRecord == false) { ?>
                                <input type="hidden" name="ClaimRequest[imageFile3]" value="<?php echo $model->imageFile3; ?>" >
                                <br/>
                                <?php if (!empty($model->imageFile3)) { ?>
                                    <a title="Download" href="<?php echo $model->imageFile3; ?>"><img src="<?php echo $model->imageFile3; ?>" height="70" width="70" ></a>
                <?php } } ?>
        </div>
    </div>
    <div class="col-md-4">
            <div style="border:1px dotted darkblue;padding: 10px">
            <?php 
			echo ($model->isNewRecord || $USERAUTH->Checkuser()=='EMP')?$form->field($model, 'imageFile4[]')->fileInput(['multiple' => false, 'accept' => 'image/*']):"";
			?>
            <?php // $form->field($model, 'imageFile4[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php if ($model->isNewRecord == false) { ?>
                                <input type="hidden" name="ClaimRequest[imageFile4]" value="<?php echo $model->imageFile4; ?>" >
                                <br/>
                                <?php if (!empty($model->imageFile4)) { ?>
                                    <a title="Download" href="<?php echo $model->imageFile4; ?>"><img src="<?php echo $model->imageFile4; ?>" height="70" width="70" ></a>
                <?php } } ?>
        </div>
    </div>
    <div class="col-md-4">
            <div style="border:1px dotted darkblue;padding: 10px">
            <?php 
			echo ($model->isNewRecord || $USERAUTH->Checkuser()=='EMP')?$form->field($model, 'imageFile5[]')->fileInput(['multiple' => false, 'accept' => 'image/*']):"";
			?>
            <?php // $form->field($model, 'imageFile5[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                <?php if ($model->isNewRecord == false) { ?>
                                <input type="hidden" name="ClaimRequest[imageFile5]" value="<?php echo $model->imageFile5; ?>" >
                                <br/>
                                <?php if (!empty($model->imageFile5)) { ?>
                                    <a title="Download" href="<?php echo $model->imageFile5; ?>"><img src="<?php echo $model->imageFile5; ?>" height="70" width="70" ></a>
                <?php } } ?>
        </div>
    </div>
   
   <?php /*<div class="col-md-12"><?= uploads($model->id) ?></div> */ ?>
   </div>
   <?php /*******************RO SECTION********* */?>
   <?php if(Authstatus($_SESSION['login_info']['username'])==2||Authstatus($_SESSION['login_info']['username'])==3 || Authstatus($_SESSION['login_info']['username'])==4){ ?>
  <div id="rosec">
  <?php include_once('_ROsecinput.php'); ?>
   <?php /* <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'fund_agency')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'fund_agency'),'required'=> true]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'nature_service')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'nature_service'),'required'=> true]) ?> </div>
   <div class="col-md-6"> <?= $form->field($model, 'ro_comment')->textarea(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'ro_comment'),'required'=> true]) ?> </div>
   </div> */?>
</div>
   <?php } ?>
  <?php ///////END RO SECTION////?>

  <?PHP //////// HO SECTION ///////?>
  <?php if(Authstatus($_SESSION['login_info']['username'])==3 || Authstatus($_SESSION['login_info']['username'])==4){ ?>
  <div id="hosec">
  <?php include_once('_HOsecinput.php'); ?>
  <?php /* <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'naturehead')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?> </div>
   <div class="col-md-3">
   
    <?php // $form->field($model, 'project_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'project_id')->DropdownList(ArrayHelper::map(Project::find()->all(),'id','name'),['prompt'=>'Select Project']) ?>
     </div>
   <div class="col-md-3"><?= $form->field($model, 'project_budget_line_id')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'costcenter_id')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?> </div>
   </div>

   <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'program_id')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'locationdescription_id')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?> </div>
   <div class="col-md-6"><?= $form->field($model, 'ho_comment')->textarea(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'mode')]) ?> </div>
   </div> */ ?>
</div>
  <?php }?>
   
   <?php //***********Accounts Section************ */?>
<?php if(Authstatus($_SESSION['login_info']['username'])==4){ ?>
<div id="acsec">
 <div class="row">
 <div class="col-md-3"><?= $form->field($model, 'tds')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'tds'),'required'=>true,'type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'advance')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'advance'),'required'=>true,'type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"><?= $form->field($model, 'net')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'net'),'required'=>true,'type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'refnumber')->textInput(['maxlength' => true,'readonly'=>readonly($model->id,$lu,'refnumber'),'required'=>true]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'refdate')->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax",'readonly'=>readonly($model->id,$lu,'refdate'),'required'=>true]) ?> </div>
   </div>
   </div>
<?php }?>

<div class="row">
   <div class="col-md-8" id="returncomment"></div>
</div>


    <div class="form-group">
    <?php 
$USERAUTH=new CheckAuth2($_SESSION['login_info']['username']);
if($USERAUTH->Checkuser()=='EMP'){
    if($model->state_id==1 or $model->state_id==2){
       // if(Rstatus($model->id)=='Return By RO'){ ?>
            <script>  $(document).ready(function(){
              $("#returncomment").html('<?= allcomments($model->id) ?>');
              $("#returncomment").append('<?= allcomments($model->id,3) ?>');
          });</script>         
              <?php // }
        echo Html::submitButton('Submit', ['class' => 'btn btn-success']);
} }elseif($USERAUTH->Checkuser()=='RO'){
    if($model->state_id==2){
       // if(Rstatus($model->id)=='Return By HO'){ ?>
            <script>  $(document).ready(function(){
                    $("#returncomment").html('<?= allcomments($model->id,3) ?>');
                    $("#returncomment").append('<?= allcomments($model->id,2) ?>');
              });</script>         
            <?php // }
    echo Html::submitButton('Submit', ['class' => 'btn btn-success','id'=>'submit']);
    echo '<button id="robtn" class="btn btn-success">Approve</button>';
    include_once('_formreturnEMP.php');
   
}      
echo '<script type="text/javascript">
$(document).ready(function(){
    $("#rosec").hide();
    //$("#hosec").hide();
   //$("#acsec").hide();
    $("#submit").hide();
});
</script>';
}elseif($USERAUTH->Checkuser()=='HO'){
    if($model->state_id==3){
          //echo AC comment display
        //  if(Rstatus($model->id)=='Return By Account Level'){ ?>
            <script>  $(document).ready(function(){
             $("#returncomment").html('<?= allcomments($model->id,4) ?>');
                $("#returncomment").append('<?= allcomments($model->id,2) ?>');
                $("#returncomment").append('<?= allcomments($model->id,3) ?>');
        });</script>         
            <?php // }
       // echo "<pre>line154 ~ ";print_r($model->id);exit;
        echo Html::submitButton('Submit', ['class' => 'btn btn-success','id'=>'submit']);
       // echo Html::submitButton('Submit', ['class' => 'btn btn-success']); 
        echo '<button id="hobtn" class="btn btn-success">Approve</button>';
    include_once('_formreturnRO.php');
    include_once('_formreturnEMPfromHO.php');
    } 
  /* echo Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]); */
echo '
<script type="text/javascript">
$(document).ready(function(){
    //$("#rosec").hide();
    $("#hosec").hide();
   // $("#acsec").hide();
    $("#submit").hide();
});
</script>';

}elseif($USERAUTH->Checkuser()=='AC'){
    if($model->state_id==4){ ?>
        <script>  $(document).ready(function(){
            $("#returncomment").html('<?= allcomments($model->id,4) ?>');
               $("#returncomment").append('<?= allcomments($model->id,2) ?>');
               $("#returncomment").append('<?= allcomments($model->id,3) ?>');
       });</script>  
    <?php    echo Html::submitButton('Submit', ['class' => 'btn btn-success','id'=>'submit']);
        echo '<button id="acbtn" class="btn btn-success">Approve</button>';
        include_once('_formreturnHO.php');
}
echo '
<script type="text/javascript">
$(document).ready(function(){
    //$("#rosec").hide();
    //$("#hosec").hide();
    $("#acsec").hide();
    $("#submit").hide();
});
</script>';
} 


?>
        <?php //Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
if(Authstatus($_SESSION['login_info']['username'])==4){ }?>
<script type="text/javascript">

$(document).ready(function(){
    
       // $("#rosec").hide();
       // $("#hosec").hide();
       // $("#acsec").hide();
       // $("#submit").hide();

    $('#robtn').click(function(){
            $("#rosec").show(1000);
            $("#comment").val('blank');
            $("#comment2").val('blank');
            $("#submit").show();
            $("#robtn").hide();
            $("#returnemp").hide();
            $("#claimrequest-ro_comment").val('');
    return false;
    });
    $('#hobtn').click(function(){
            $("#hosec").show(1000);
            $("#comment").val('blank');
            $("#comment2").val('blank');
            $("#submit").show();
            $("#hobtn").hide();
            $("#returnemp").hide();
            $("#claimrequest-ho_comment").val('');
    return false;
    });
    $('#acbtn').click(function(){
            $("#acsec").show(1000);
            $("#comment").val('blank');
            $("#comment2").val('blank');
            $("#submit").show();
            $("#acbtn").hide();
            $("#returnho").hide();
    return false;
    });

}); 

</script> 
<script type="text/javascript">
function ajaxamount2word(){
        var rupe = document.getElementById("claimrequest-amount").value;
         if(rupe==''){
            $('#claimrequest-amountinword').val('zero');
         }else{
         $.ajax({
             url: '<?php echo Url::to(["site/num2word"]); ?>',
             type: 'post',
             data: {rupe : rupe,},
             success: function (data) {
                $("#claimrequest-amountinword").val(data)
                console.log(data)},
             error: function (jsonResponse) {
                 console.log(jsonResponse); }
         });}}
</script>