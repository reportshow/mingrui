<?php
namespace apps\controllers;

use Yii; 
use yii\web\Controller;
use apps\models\Mainlist;
use apps\models\Information;

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
        $modellist = Mainlist::find()->all();
        return $this->render('index',[
                'modellist' => $modellist,
            ]);
    }

     public function actionClass($classid)
    {
        //$mainlist = 
        //$clsModel  =  Mainlist::find()->where(['classname'=> $class])->one();
        $clsModel  =  Mainlist::findOne($classid);
        if(!$clsModel) { 
        	return "<h1>查找不到对应的分类</h1>";
        } 

        $classname = $clsModel->name;

        $infolist = Information::find()
        	->where(['like','class', $clsModel->classname])
        	->groupBy('class')
        	->all();
        if(!$infolist) { 
        	return "<h1>查找不到对应的分类的子类</h1>";
        }

        return $this->render('class',[
                'infolist' => $infolist,
                'classname' => $classname,
            ]);
    }


    public function actionSubclass($subclass)
    {
        $clsModel  =  Information::findOne($subclass);
        if(!$clsModel) { 
        	return "查找不到对应的分类";
        }

        $subclassname = $clsModel->class;

        $infolist = Information::find()
        	->where([ 'class'=> $subclassname])
        	 ->all();

       // echo $query->createCommand()->getRawSql(); exit;

        return $this->render('subclass',[
                'infolist' => $infolist,
                'model' => $clsModel,
            ]);
    }

    public function actionSubinfo($subid)
    { 
    	$clsModel  =  Information::findOne($subid);
    	 if(!$clsModel) { 
        	return "查找不到对应的分类";
        }

        return $this->render('info',[ 
                'model' => $clsModel,
            ]);

    }
 
}
