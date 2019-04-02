<?php
use yii\helpers\Url;
?>

 <button type="button" class="btn btn-primary" id="returnho" data-toggle="modal" data-target="#myModal">
 Return to HO
</button>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="alert" >Enter Reason</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      
<fieldset>

<!-- Form Name -->
<input type="hidden" id="claim_id" name="claim_id" value="<?= $model->id ?>" >
<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="textarea">comment</label>
  <div class="col-md-10">                     
    <textarea class="form-control" id="comment" placeholder="Comment here" name="comment" required></textarea>
  </div>
</div>
<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    </div>
</div>
</fieldset>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
      <button onclick="ajaxcomment()" type="submit" class="btn btn-success">Save </button> 
        <button type="button" class="btn btn-danger" onclick="document.getElementById('comment').value=''" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    $("#returnho").click(function(){
        $("#comment").val('');
    });
});
function ajaxcomment(){
        
        var ac_comment = document.getElementById("comment").value;
         var reqid = document.getElementById("claim_id").value;
         if(ac_comment==''){
            $('#alert').html('<div class="alert alert-danger" role="alert"> Please Enter Reason!</div>');
         }else{

         
         //console.log("Co2",year)
         $.ajax({
             url: '<?php echo Url::to(["claim-request/return"]); ?>',
             type: 'post',
             data: {
                ac_comment:ac_comment,
                  id : reqid,
                 _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
             },
             beforeSend: function () {
                 ajaxIndicatorStart("Please wait...", '<?php echo Url::to("@web/css/loading.gif") ?>');
             },
             complete: function () {
                ajaxIndicatorStop();
             },
             success: function (data) {
                 console.log("Return",data);
                 $('#myModal').modal('toggle');
                 location.replace("<?php echo Url::to(['/claim-request/index']) ?>");
                // alert(data);
                // dataCo2EnessionReductionLineChart(data);
             },
             error: function (jsonResponse) {
                 console.log(jsonResponse);
                 //alert("Something went wrong in Solar Irrigation Area.");
             }
         });
         }
     }

</script>



<script type="text/javascript">
     function ajaxIndicatorStart(message, pathOfAjaxLoadingImage)
{
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="' + pathOfAjaxLoadingImage + '"><div>' + message + '</div></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.6',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxIndicatorStop()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}
     </script>