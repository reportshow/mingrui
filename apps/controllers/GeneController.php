<?php
namespace apps\controllers;

use Yii; 
use yii\web\Controller;
use apps\models\Mainlist;

/**
 * Site controller
 */
class GeneController extends Controller
{
   
 

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model= Mainlist::find()->all();
        return $this->render('index',[
                'modellist' => $model,
            ]);
    }

     public function actionClass($class)
    {
        
        echo "test ";
    }
 
}
