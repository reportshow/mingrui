<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\widgets\RestrepotTop;
use backend\components\Functions;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name; 
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title . '      数据自分析';

AppAsset::register($this); 
?>
<?=RestrepotTop::widget(['model_id'=>$model->id]); ?>

<?php

 if(Functions::ismobile()){
?>
 	<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> 提示!</h4>
                请您打开电脑版使用数据分析功能
     </div>
<?php

  return;
}//ismobile
?>

<style type="text/css">
#autoscroll{
    height:100%;
    overflow:auto;
    width:100%;
    text-align:center;
}
.barbox{
    width:960px;
    height:100%;
    text-align:left;
    margin:auto;
}
.head{
    width:958px;
    height:200px;
    border:1px solid #eb6100;
    margin-top:10px;
    margin-bottom:10px;
}
.tool{
    width:958px;
    border:1px solid #eb6100;
    background:#FFF;
}
.toolabsolute{
    position:fixed;
    z-index:10000;
    top: 0;
}
.list{
    width:958px;
    height:2400px;
    border:1px solid #eb6100;
    margin-top:10px;
    margin-bottom:10px;
}
</style>

<div id="autoscroll">
  <div class="barbox">
    <div class="tool" id="mytool">
      hjkkll
    </div>
  </div>
</div>
<div class="barbox">
  <div class="tool toolabsolute">
    <?= $this->title?>
  </div>
</div>

<div id="app"></div>
<script>
    var tableData = <?php echo $data ?>;
</script>

<link type="text/css" href="css/multiselect.css" rel="stylesheet" />
<script src="report/app.js"></script>
<script src="report/export.js"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
        var mytooltop;
        var scrolltop;
        var toolleft;
        var cloned=false;
	//$(".toolabsolute").hide();
        $("#autoscroll").scroll(function(){
	    mytooltop=$("#mytool").get(0).offsetTop;
	    scrolltop=document.getElementById("autoscroll").scrollTop;
            if(scrolltop>=mytooltop){
                $(".toolabsolute").show();
            }
            if(!(scrolltop>=mytooltop)){
                $(".toolabsolute").hide();
            }
        })
    })
</script>

