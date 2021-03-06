<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

$this->title = $mainclass->name;

include_once('header.php');
?>
<script type="text/javascript" src='js/jquery.autosuggest.min.js'></script>

<h3><?=$this->title?> 大类</h3>
<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);

$listData = [];

//var_dump($infolist); exit;
foreach ($infolist as $key => $obj) {
	 $listData[$obj->id] = $obj->class . '-(' . $obj->genecount .')';
}

//var_dump($model);
//$listData = ArrayHelper::map($infolist,'id', 'class');

$model = $infolist[0];

//var_dump($listData);
//exit;

 echo $form->field($model, 'class')->dropDownList(
 	     $listData,  ['prompt'=>'选择产品...' /*,'onchange'=>'cc'*/
 	     ]
 	  );



 ActiveForm::end();
 ?>

 <br>搜具体疾病名
  <div class="input-group  text-black">
    <input type="text"   name='keyword' placeholder='搜具体疾病名(多个用空格隔开)'  class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-info btn-flat"  id='search'>搜索</button>
        </span>
  </div>

 <br>搜基因
  <div class="input-group  text-black">
    <input type="text"   name='gene' placeholder='搜基因(多个用空格隔开)'  class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-info btn-flat"  id='searchgene'>搜索</button>
        </span>
  </div>


 <script>
$('#information-class').change(function(){
	var key = ($(this).val());
	location.href= "?r=gene/subclass&subclass="+key;
});

$('#search').click(function(){
	var keyword = $("input[name='keyword']").val();
	location.href= "<?=Yii::$app->urlManager->createUrl(['gene/subclass2', 'key' => $mainclass->classname]) ?>"
	   + "&keyword="+keyword;
});
$('#searchgene').click(function(){
    var gene = $("input[name='gene']").val();
    location.href= "<?=Yii::$app->urlManager->createUrl(['gene/subclass3', 'key' => $mainclass->classname]) ?>"
       + "&gene="+gene;
});


$(function(){
         $("input[name='keyword']").autosuggest({
            url: '<?=Yii::$app->urlManager->createUrl(['gene/classjson','key'=>$mainclass->classname])?>' ,
            method: 'POST',
            queryParamName: 'keyword',
            //split: ' ',user input split
            /*dataCallback:function(data) {
                var json = [];
                if (data.S === 10006) {
                    for (var i = 0; i < data.list.length; i++) {
                        json.push({ value: data.list[i].TagName,  label: data.list[i].GroupName + '=>' + data.list[i].TagName });
                    }
                    return  json;
                }
                return json;
            },*/
             onSelect:function(elm) {
                location.href = "<?=Yii::$app->urlManager->createUrl(['gene/subclass2', 'key' => $mainclass->classname]) ?>"
	                        + "&keyword="+  elm.data('label') ;
            }
        });



})
 </script>

<style>
.as-wrapper{position:inherit}.as-wrapper .as-menu{position:absolute;z-index:1000;width:100%;display:none}.as-wrapper .as-selected{background-color:#f5f5f5}.as-align-left{text-align:left}.as-align-right{text-align:right}.as-align-center{text-align:center}
</style>



<?php
echo $this->render('case',[
	'caselist'=>$caselist
	]);

?>