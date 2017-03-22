<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

include_once('header.php');

$this->title = '金准基因产品结构信息';

?>
<h2>金准基因产品结构信息</h2>
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
    <input type="text"   name='huohao' placeholder='按基因找货号'  class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-info btn-flat"  id='search_huohao'>按基因找货号</button>
        </span>
  </div>
 




 <br><hr><br>症状搜基因
  <div class="input-group  ">
    <input type="text" name='keyword_cn' placeholder='症状关键字'  class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-info btn-flat" id='search_cn'>症状搜基因</button>
        </span>
  </div>

<br>基因搜症状
  <div class="input-group  ">
    <input type="text"   name='keyword_gene' placeholder='基因名'  class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-info btn-flat"  id='search_gene'>基因搜症状</button>
        </span>
  </div>
 

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
 </script>