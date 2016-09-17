<?php

namespace backend\controllers;

use Yii;
use backend\models\MingruiVideo;
use backend\models\MingruiVideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MingruiVideoController implements the CRUD actions for MingruiVideo model.
 */
class  Video2Controller extends Controller
{
     

    /**
     * Lists all MingruiVideo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $videoUrl =  Yii::$app->params['videoserver'] . "/videos";
        $content= "<iframe src='$videoUrl'  width=100% height=100% style='min-height:500px'></iframe>";
         
        return $this->render(
            '/layouts/main-login',
            ['content' => $content]
        );

    }
 
}
