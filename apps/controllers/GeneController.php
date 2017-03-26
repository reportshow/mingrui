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
        	->where([ 'key' =>$clsModel->classname])
        	->groupBy('class')
        	->all();
        if(!$infolist) { 
        	return "<h1>查找不到对应的分类的子类</h1>";
        } 

        return $this->render('class',[
                'infolist' => $infolist,
                'mainclass' => $clsModel,
            ]);
    }

    public function actionClassjson($key){ 
    	$this->layout = false; 
    	$keyword = Yii::$app->request->post('keyword');
    	$query = Information::find()
        	->where([ 'key'=> $key]);
 
        $query = $query ->andWhere(['like','sick',$keyword]); 
        $infolist= $query->limit(10) ->all();
        
        //var_dump($infolist);
        $list = [];
        foreach ($infolist as $key => $info) {
        	 $list[] = ["label"=>$info->sick, 'value'=>$info->sick, 'id'=>$info->id];
        }
        return json_encode($list);
    	return 
		"[ 
		  {
		   \"id\" : \"10\", 
		   \"value\" : \"55\",
		   \"label\" : \"some label name\"
		  }
		]";

    }


    public function actionSubclass($subclass)
    {    //groupby --$subclass
        $firstOne  =  Information::findOne($subclass);
        if(!$firstOne) { 
        	return "查找不到对应的分类";
        }

        $key = $firstOne->key;
        return $this->actionSubclass2($key,null);
    }
    

    public function actionSubclass2($key,$keyword)
    {   
        return $this->showSubClass($key, $keyword);
    }


    function showSubClass($key, $name_keywords=null)
    { 
        $query = Information::find()
        	->where([ 'key'=> $key]);

        if($name_keywords){ 
        	 $query = $query ->andWhere(['like','sick',$name_keywords]);
        }
        
        $infolist= $query ->all();

       // echo $query->createCommand()->getRawSql(); exit;
        if(count($infolist) <1) return 'no data!';
        return $this->render('subclass',[
                'infolist' => $infolist,
                'model' => $infolist[0],
                'keywords'=>$name_keywords
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

    
    //gene-->货号
    public function actionSearchhuohao($keywords){ 
    	$keywords = str_replace('　', ' ', $keywords);
    	$keys = array_filter(explode(' ',$keywords));
    	foreach ($keys as $k => $value) {
    		 $keys[$k]=strtoupper($value);
    	}

    	$models = Information::find()->where(['in','gene', $keys])
    	         ->all();
    	$list = array();
    	$listid = [];
    	foreach ($models as   $m) {
    		 $main = $m->main;
    		 $list[$main->number][] = $m->gene;
    		 $listid[$main->number] = $main->id;
    	}
    	foreach ($list as $num => $genelist) {
    		 $list[$num] = ['genes'=>array_unique($genelist), 'id'=>$listid[$num]  ];
    	}


    	return $this->render('search-huohao',[ 
                'list' => $list,
                'keywords'=>$keywords
            ]);
    }

    //搜症状-->gene
    public function actionSearch($keywords){ 
    	$models = Chpo::find()->where(['like','chpo',$keywords])->all();
    	return $this->render('searchsick',[ 
                'models' => $models,
                'keywords'=>$keywords
            ]);
    }
    //gene-->症状
    public function actionSearchgene($keywords){ 
    	$models = Chpo::find()->where(['like','gene',$keywords])->all();
    	return $this->render('searchsick',[ 
                'models' => $models,
                'keywords'=>$keywords
            ]);
    }

       
 
}
