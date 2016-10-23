<?php
namespace backend\widgets;
use Yii;
use yii\base\Widget;

class RestrepotTop2 extends Widget
{
    public $model_id;
    public function run()
    {

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

        return $this->render('RestrepotTop2', ['model_id' => $this->model_id,'active'=>$active]);
    }

}
