<?php
use backend\assets\AppAsset;
use backend\models\RestReport;
use backend\widgets\PdfShow;
use backend\widgets\RestrepotTop2;
use backend\components\Functions;
use backend\widgets\Pdf2html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */
$id = $_GET['id'];
global $sick;
$report = RestReport::findOne($id);
$sick   = $model->sample->name;

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $sick, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '报告详情';

AppAsset::register($this);
//$this->registerJsFile('@web/js/pdfobject.min.js',['position' => POS_HEAD,'depends'=>['backend\assets\AppAsset']]);
//$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]);

 
 
$pdfshowUrl = Functions::url(['rest-report/pdf2html','id'=>$model->id]);

?>


<?=RestrepotTop2::widget(['model_id' => $model->id]);?>



<?php

if ($model->pdfurl) {
//使用ERP的pdf
    $pdfurl = $model->pdfurl;
} else {
    echo "<h1>抱歉，没有报告数据！</h1>";
    return;
}
 
?>

<div class="progress progress-sm active">
	<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
	  <span class="sr-only">20% Complete</span>
	</div>
</div>

<iframe src="<?=$pdfshowUrl ?>" width=100% height=100% style='min-height:900px' frameborder=0></iframe>
 
<script type="text/javascript">
	$('iframe').contents().find("body").html('加载中。。。。');
	$('iframe').load(function() { 
	    $('.progress').remove();
	    reHeight();
	    $("iframe").contents().find("#page-container .y12").eq(1).html("<div class='blur' style='padding:8px;text-align: center;'>这是一个医院名</div>");
	}); 
	var per =0;
	setInterval(function(){
		per+=10;
		$('.progress-bar').css('width', per +'%');
	},200);
 
 function reHeight(){	  
	   var h = 0;//  $("iframe").contents().find("#page-container").height();
	   var allpf = $("iframe").contents().find("#page-container .pf");
	   var pfcount = 0;

	   allpf.each(function(i,e){
		   	 h+=$(this).height();
		   	 pfcount++;
		   	 if(pfcount==allpf.length){
		   	 	if(h > 1000){
			      $("#page-container").height(h+150);
			      $("iframe").height(h+150); 
			   }
		   	 }
	   });
	   $("iframe").contents().find("#page-container .pc").css('display','block');
	   

  } 
</script>