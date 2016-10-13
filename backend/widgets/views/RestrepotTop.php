<?php
use yii\helpers\Html;
use backend\models\MingruiPingjia;
use backend\components\Functions;

$controllerID = Yii::$app->controller->id;
$actionID     = Yii::$app->controller->action->id;

$active = ['view' => '', 'show-report' => '', 'comments'=>'', 'stats' => '', 'index' => '', 'analyze' => ''];
switch ($actionID) {
    case 'view':
        $activeid = 'view';
        break;
    case 'comments':
        $activeid = 'comments';
        break;
    case 'show-report':
        $activeid = 'show-report';
        break;
    case 'stats':
        $activeid = 'stats';
        break;
    case 'index': //mingrui-attachment
        $activeid = 'index';
        break;
    case 'analyze':
        $activeid = 'analyze';
        break;
    default:
        # code...
        break;
}
$active[$activeid] = 'active';

$pingjiaUrl = Yii::$app->urlManager->createUrl(['pingjia/save-xingji']);



$styleboxtop = Functions::ismobile() ? '0px' : '150px';
?>
 <style type="text/css">
   .btn.active{
      box-shadow: inset 0 3px 5px rgba(0, 0, 0, .7);
    }

@media screen and (min-width: 640px) {    
  .summary.btn{display: none}
}
.summary.btn{
   width: 50px;height:65px;float: left;margin-right: 5px;box-shadow: 1px 1px 1px #333; padding: 0px;
}
.summary.btn i{font-size: 40px;color: #FFFFFF;    line-height: 65px;}
</style>

<p>

 <?=Html::a('<i class=" fa fa-calendar-plus-o" ></i>', ['rest-report/view', 'id' => $model_id], [
    'class' => 'summary btn btn-info ' . $active['view'],
])?>




<?=Html::a('报告详情', ['rest-report/show-report', 'id' => $model_id], [
    'class' => 'btn btn-success ' . $active['show-report'],
])?>

<?=Html::a('意见反馈', ['rest-report/comments', 'id' => $model_id], [
    'class' => 'btn btn-info ' . $active['comments'],
])?>

<?=Html::a('星级评价', '#', [
    'class' => 'btn btn-info '  ,
    'onclick'=>'abc()'
])?>


<?=Html::a('报告归类', ['rest-report/stats', 'id' => $model_id], [
    'class' => 'btn btn-primary ' . $active['stats'],
])?>



<?=Html::a('完善资料', ['mingrui-attachment/', 'reportid' => $model_id], [
    'class' => 'btn btn-warning ' . $active['index'],
])?>
 
<?=Html::a('数据分析', ['rest-report/analyze', 'id' => $model_id], [
    'class' => 'btn btn-danger ' . $active['analyze'],
])?>

</p>





<style type="text/css">
    .pingjia  p{margin-left:40px;}
    .pingjia i{font-style:normal; }
    .pingjia .tag{display: inline-block; width:60px; font-size:1.5em}
    .pingjia .tag2{display: inline-block; width:120px;  }
    .pingjia .tagtxt{display: inline-block; width:50px;}
    .pingjia input{color:#222;}
    .pingjia input[type=radio]{margin-right:20px; width: 18px; height: 18px;}
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
         foreach ($index =0; $index < $count; as $index++) {
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

             echo  "<p><input type=radio name='pingjia' value='$index'>
                    <i class='tag'>$listStr</i> <i class='tag2'>$label</i> $desc 
                   </p> ";        

          } 
       ?>
             <p><input type=radio name='pingjia' value='6'><i class='tag fa fa-edit' style=""></i>
                 <input type=text maxlength="16" placeholder="自定义">   
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
        $.ajax({
             type: "POST",
             url:  url,
             data: {report_id: '<?=$model_id?>', pingjia: val},
             dataType: "json",
             success: function(d){
                  if(d.code==1){
                     $('#xingjipingjiaBox').slideUp();
                  }
             }
         });
    });

  
    
</script>

