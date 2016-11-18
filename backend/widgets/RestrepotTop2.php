<?php
namespace backend\widgets;

use backend\components\Functions;
use Yii;
use yii\base\Widget;
use backend\models\RestReport;

class RestrepotTop2 extends Widget
{
    public $model_id;
    public function run()
    {    $roletext = Yii::$app->user->Identity->role_text;
         if(!Yii::$app->user->can('admin')){
           $report = RestReport::findOne($this->model_id);
            if($report->sample){
                if($report->sample->doctor_id!=Yii::$app->user->Identity->role_tab_id){
                     echo   Nodata::widget(['message' => '你没有查看此报告的权限']);
                    exit();
                }
           } 
         }
         


        $controllerID = Yii::$app->controller->id;
        $actionID     = Yii::$app->controller->action->id;

        $active = ['view' => '', 'show-report' => '', 'comments' => '', 'stats' => '', 'index' => '', 'analyze' => ''];
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
        if (!Functions::ismobile()) {
            if ($active['view'] == 'active') {
                $active['comments'] = 'active';
            }
            $active['view'] = 'hide';
        }

        return $this->render('RestrepotTop2', ['model_id' => $this->model_id, 'active' => $active]);
    }

}
