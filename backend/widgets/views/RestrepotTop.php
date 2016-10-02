<?php
use yii\helpers\Html;

$controllerID = Yii::$app->controller->id;
$actionID     = Yii::$app->controller->action->id;

$active = ['view' => '', 'show-report' => '', 'stats' => '', 'index' => '', 'analyze' => ''];
switch ($actionID) {
    case 'view':
        $activeid = 'view';
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
</style>

    <p>


<?=Html::a('意见反馈', ['rest-report/view', 'id' => $report_id], [
    'class' => 'btn btn-info ' . $active['view'],
])?>


<?=Html::a('报告详情', ['show-report', 'id' => $report_id], [
    'class' => 'btn btn-success ' . $active['show-report'],
])?>

<?=Html::a('报告归类', ['rest-report/stats', 'id' => $report_id], [
    'class' => 'btn btn-primary ' . $active['stats'],
])?>



<?=Html::a('完善资料', ['mingrui-attachment/', 'reportid' => $report_id], [
    'class' => 'btn btn-warning ' . $active['index'],
])?>

&nbsp;&nbsp;&nbsp;
<?=Html::a('数据分析', ['rest-report/analyze', 'id' => $report_id], [
    'class' => 'btn btn-danger ' . $active['analyze'],
])?>
    </p>
