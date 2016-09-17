<?php

namespace backend\controllers;

use backend\models\MingruiVideo;
use Yii;
use yii\web\Controller;

/**
 * MingruiVideoController implements the CRUD actions for MingruiVideo model.
 */
class Video2Controller extends Controller
{

    /**
     * Lists all MingruiVideo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $videoUrl = Yii::$app->params['videoserver'] . "/videos";
        $content  = "<iframe src='$videoUrl'  width=100% height=100% style='min-height:600px'></iframe>";

        return $this->render(
            '/layouts/main-login',
            ['content' => $content, 'title' => '视频']
        );

    }

}
