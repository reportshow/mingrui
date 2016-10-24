<?php
use backend\components\Functions;

$pingjiaUrl = Functions::url(['pingjia/save-xingji']);

?><div class="nav-tabs-custom" id="reportTop">
  <ul class="nav nav-tabs">

    <li class="<?=$active['view']?>"><a href="<?=Functions::url(['rest-report/view', 'id' => $model_id])?>">报告摘要</a></li>
    <li  class='<?=$active['show-report']?>'><a href="<?=Functions::url(['rest-report/show-report', 'id' => $model_id])?>">报告详情</a></li>
    <li class='<?=$active['comments']?>'><a href="<?=Functions::url(['rest-report/comments', 'id' => $model_id])?>" >意见反馈</a></li>
    <li onclick="abc()"><a href="#" >星级评价</a></li>
    <li class='<?=$active['stats']?>'><a href="<?=Functions::url(['rest-report/stats', 'id' => $model_id])?>"  >报告归类</a></li>
    <li class='<?=$active['index']?>'><a href="<?=Functions::url(['mingrui-attachment/', 'reportid' => $model_id])?>"  >完善资料</a></li>
    <li class='<?=$active['analyze']?>'><a href="<?=Functions::url(['rest-report/analyze', 'id' => $model_id])?>" >数据分析</a></li>


    <li class="dropdown hide" >
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        Dropdown <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
        <li role="presentation" class="divider"></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
      </ul>
    </li>
    <li class="pull-right hide"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
  </ul>
  <div class="tab-content hide"></div>
</div>





<?php
 echo $this->render('RestrepotTopXingji', ['model_id' => $model_id]);

?>
