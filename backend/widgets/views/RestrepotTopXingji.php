<?php

use yii\helpers\Html;
use backend\models\MingruiPingjia;
use backend\components\Functions;

$pingjiaUrl = Yii::$app->urlManager->createUrl(['pingjia/save-xingji']);
$styleboxtop = Functions::ismobile() ? '0px' : '150px';

$pingjiaObj = MingruiPingjia::find()->where(['report_id'=>$model_id])->one();
$pingjiaIndex = -1;
$pingjiaDiyChecked =$pingjiaDiy= '';
if($pingjiaObj){ 
  $pingjiaIndex = $pingjiaObj->pingjia;
  $pingjiaDiy= $pingjiaObj->pingjiaDiy;

  $pingjiaDiyChecked = $pingjiaObj->pingjia==6 ? 'checked' : '';
}

?>
<style type="text/css">
    .pingjia  p{margin-left:40px;}
    .pingjia i{font-style:normal; }
    .pingjia .tag{display: inline-block; width:60px; font-size:1.5em}
    .pingjia .tag2{display: inline-block; width:120px;  }
    .pingjia .tagtxt{display: inline-block; width:50px;}
    .pingjia input{color:#222;}
    .pingjia input[type=checkbox]{margin-right:20px; width: 18px; height: 18px;}
</style>
<div class="example-modal" >
<div class="modal modal-primary" id='xingjipingjiaBox'>
  <div class="modal-dialog" style="margin-top: <?=$styleboxtop ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity:1;color:#fff">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">星级评价</h4>
      </div>
      <div class="modal-body">
        <div class='pingjia' >
        <?php
        $count = count(MingruiPingjia::$pingjiaText);
     
         for($index =1; $index < $count;   $index++) {
             $value = MingruiPingjia::$pingjiaText[$index];
             $star = $value['key'];
             $label = $value['label'];
             $desc = Functions::ismobile() ? '' : $value['description'];
             $staricon = $star;
             $list = explode('|',  $star);
             $listStr = '';
             foreach ($list as $key => $one) {
               $listStr .= "<i class='fa $one'></i> ";
             }
             $checked = $pingjiaIndex ==$index ? 'checked' : '';

             echo  "<p><input type=checkbox name='pingjia' value='$index' $checked>
                    <i class='tag'>$listStr</i> <i class='tag2'>$label</i> $desc 
                   </p> ";        

          } 
       ?>
             <p><input type=checkbox name='pingjia' value='6' <?=$pingjiaDiyChecked ?> >
                 <i class='tag fa fa-edit' style=""></i>
                 <input id='pingjiaDiy' type=text maxlength="16" placeholder="自定义" 
                    style='width:120px' value='<?=$pingjiaDiy?>'>   
             </p>  
        </div>
      </div>
      <div class="modal-footer">
        <span type="button" class="btn btn-outline pull-left close" data-dismiss="modal"  
        style="font-weight: normal;font-size:1em;opacity: 1;text-shadow:none" > 取 消 </span>
        <button type="button" class="btn btn-outline" id='pingjisendBtn'> 确 定 </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
<!-- /.example-modal -->

<script type="text/javascript">
    function abc(){
       $('#xingjipingjiaBox').show();
    } 
    $('.close').click(function(){
       $('#xingjipingjiaBox').hide();
    });
    $('#pingjisendBtn').click(function(){
        var url = "<?=$pingjiaUrl ?>";
        var val = $('#xingjipingjiaBox input[name="pingjia"]:checked').val();
        var pingjiaDiy = $('#pingjiaDiy').val();
        $.ajax({
             type: "POST",
             url:  url,
             data: {report_id: '<?=$model_id?>', 'pingjia': val, 'pingjiaDiy':pingjiaDiy},
             dataType: "json",
             success: function(d){
                  if(d.code==1){
                     $('#xingjipingjiaBox').slideUp();
                  }
             }
         });
    });

  $('#xingjipingjiaBox input[name="pingjia"]').click(function(){
     var obj =$(this);
     var ck = $(this).is(':checked');
     $('#xingjipingjiaBox input[name="pingjia"]').each(function(){
        if(obj.val()!=$(this).val()){
          $(this).attr('checked', false);
        } 
     });
     //obj.attr('checked', !ck);
     
  });
    
</script>

