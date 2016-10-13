<?php

namespace backend\controllers;

use backend\models\MingruiOrder;
use backend\models\userMessage;
use Yii;
use yii\web\Controller;

/**
 * OrdersController implements the CRUD actions for MingruiOrder model.
 */
class StatusController extends Controller
{

    public $layout = false;
    /**
     * status for   orders / pdf msg count / guestbook count
     * @return [type] [description]
     */
    public function actionStatus()
    {
        $status                    = [];
        $status['orders']['count'] = MingruiOrder::find()->where(['status' => 'init'])->count() + 0;
        $status['orders']['url']   = Yii::$app->urlManager->createUrl(['/orders/']);

        $status['message']       = userMessage::format4web(userMessage::myMessages());
        $status['reportMessage'] = userMessage::format4web(userMessage::reportMessage());

        exit(json_encode($status));

    }

}
