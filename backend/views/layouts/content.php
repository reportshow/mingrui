<?php
use dmstr\widgets\Alert;
use yii\widgets\Breadcrumbs;
use backend\components\Functions;

?>
<style type="text/css">
  @media (max-width: 767px){
    .sidebar-open .menuRightcover{
     display:block;
    }
  }
  .menuRightcover{
    /* background:red; */
    height:100%;width:100%;
    position: absolute;
    z-index: 10000;
    display: none;
  }
  
</style>
<div class="content-wrapper" style="min-height:970px">
<div class="menuRightcover"> </div>

    <section class="content-header" >
        <?php if (0 && isset($this->blocks['content-header'])) {
          ?>
            <h1><?=$this->blocks['content-header']?></h1>
        <?php } else {
        ?>
            <h1>
                <?php
    if ($this->title !== null) {
        echo \yii\helpers\Html::encode($this->title);
    } else {
        /*echo \yii\helpers\Inflector::camel2words(
            \yii\helpers\Inflector::id2camel($this->context->module->id)
        );
        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';*/
    }?>
            </h1>
        <?php }?>

        <?php
	        if(!Functions::ismobile()){
	           if (Yii::$app->user->can('admin') || Yii::$app->user->can('doctor')) {
	            
	           }
	        }
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);

      ?>
    </section>

    <section class="content">
        <?=Alert::widget()?>
        <?=$content?>
    </section>


</div>



<footer class="main-footer" style="font-size: 0.9em">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
     <strong><a href="#">明睿单病云管家</a>
       Copyright &copy; 2014-2016
      </strong>    All rights    reserved.
      
      <script type="text/javascript"> 
        var _czc = _czc || []; 
        _czc.push(["_setCustomVar","用户类型", userType,2]);
      </script>
      <script src="http://s11.cnzz.com/z_stat.php?id=1261409829&web_id=1261409829" language="JavaScript"></script>

   <?php   //password  mono123
    ?>
</footer>
