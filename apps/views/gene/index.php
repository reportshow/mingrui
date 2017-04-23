<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

include_once('header.php');

$this->title = '金准基因单病产品总表';

?>
<script type="text/javascript" src='js/jquery.autosuggest.min.js'></script>






<h3>金准基因单病产品总表</h3>
<?php
//var_dump($model);
$listData = ArrayHelper::map($modellist,'id', 'name');
$model = $modellist[0];
//var_dump($listData);

 $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);

 echo $form->field($model, 'name')->dropDownList(
 	     $listData,  ['prompt'=>'选择产品...' ,'onchange'=>'cc']
 	  )->label(false);



 ActiveForm::end();
 ?>
<br>按基因找货号
  <div class="input-group  ">
    <input type="text"   name='huohao' placeholder='多个基因用空格分开'  class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-info btn-flat"  id='search_huohao'>搜货号</button>
        </span>
  </div>




<br><br><br><br>

(表型词条来自CHPO)
 <DIV class="box box-primary  ">
             <div class="box-header with-border">
              <h3 class="box-title">表型←→基因</h3>


              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->


        <div class="box-body">

          <div class="input-group  ">
		    <input type="text" id='symptom' name='keyword_cn' placeholder='表型关键字(多个用空格分开)'  class="form-control">
		        <span class="input-group-btn">
		          <button type="button" class="btn btn-info btn-flat" id='search_cn'>表型→基因</button>
		        </span>
		  </div>

		  <br>基因搜表型
		  <div class="input-group  ">
		    <input type="text"   name='keyword_gene' placeholder='基因名'  class="form-control">
		        <span class="input-group-btn">
		          <button type="button" class="btn btn-info btn-flat"  id='search_gene'>基因→表型</button>
		        </span>
		  </div>






        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
</DIV>





 <script>



$('#mainlist-name').change(function(){
	var id = ($(this).val());
	location.href= "?r=gene/class&classid="+id;

});

$('#search_huohao').click(function(){
	var keyword = $("input[name='huohao']").val();
	location.href = '?r=gene/searchhuohao&keywords=' + keyword;
});

$('#search_cn').click(function(){
	var keyword = $("input[name='keyword_cn']").val();
	location.href = '?r=gene/search&keywords=' + keyword;
});
$('#search_gene').click(function(){
	var keyword = $("input[name='keyword_gene']").val();
	location.href = '?r=gene/searchgene&keywords=' + keyword;
});


$(function(){
	 var oldtext = '';
	 $("#symptom").change(function(){ 
	 	oldtext = $(this).val();
	 });
     $("#symptom").autosuggest({
        url: "<?=Yii::$app->urlManager->createUrl(['symptom/search'])?>" ,
        method: 'POST',
        queryParamName: 'keyword',
        //split: ' ',user input split
        /*dataCallback:function(data) {

        },*/
         onSelect:function(elm) {
         	var t = oldtext;
         	var p = oldtext.lastIndexOf(' ')
         	if(p > 0){ 
         		t = t.substr(0, p);
         	}else{ 
         		t ='';
         	 }
         	$('#symptom').val(t+" " + elm.text());
         	return false;
        }
    });



});
 </script>

<style>
.as-wrapper{position:inherit; color:#333;}.as-wrapper .as-menu{position:absolute;z-index:1000;width:100%;display:none}.as-wrapper .as-selected{background-color:#f5f5f5}.as-align-left{text-align:left}.as-align-right{text-align:right}.as-align-center{text-align:center}
</style>