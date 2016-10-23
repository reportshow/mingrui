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



<?php
 echo $this->render('RestrepotTopXingji', ['model_id' => $model_id]);

?>
