<?php
namespace apps\controllers;

use Yii; 
use yii\web\Controller;
use apps\models\Mainlist;
use apps\models\Information;
use apps\models\Chpo;

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


    public function actionDetail($id)
    {
        $model  =  Mainlist::findOne($id);
        return $this->render('index-detail',[
             'model' => $model,
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

        if(!$clsModel->hassub){ 
          return $this->redirect(['detail','id'=>$classid]);
        }

        if(!$clsModel->classname){ 
        	return "<h1>查找不到对应的分类的子类</h1>";
        } 


        $infolist = Information::find()
        	->where(['like','class', $clsModel->classname])
        	->groupBy('class')
        	->all();
        if(!$infolist) { 
        	return "<h1>查找不到对应的分类的子类</h1>";
        } 

        return $this->render('class',[
                'infolist' => $infolist,
                'classname' => $clsModel->name,
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

    public function actionSearch($keywords){ 
    	$models = Chpo::find()->where(['like','chpo',$keywords])->all();
    	return $this->render('searchsick',[ 
                'models' => $models,
                'keywords'=>$keywords
            ]);
    }

    public function actionSearchgene($keywords){ 
    	$models = Chpo::find()->where(['like','gene',$keywords])->all();
    	return $this->render('searchsick',[ 
                'models' => $models,
                'keywords'=>$keywords
            ]);
    }

       
 
}
