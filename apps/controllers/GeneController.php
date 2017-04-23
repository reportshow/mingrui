<?php
namespace apps\controllers;

use Yii;
use yii\web\Controller;
use apps\models\Mainlist;
use apps\models\Information;
use apps\models\Chpo;
use backend\models\MingruiDoc;

error_reporting(E_ALL^E_NOTICE);


/**
 * Site controller
 */
class GeneController extends Controller
{

   public $enableCsrfValidation = false;

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
        $ids = explode(',', $clsModel->caselist);
        $caselist = MingruiDoc::find()->where(['in','id', $ids])->all();

        return $this->render('class',[
                'infolist' => $infolist,
                'mainclass' => $clsModel,
                'caselist' =>$caselist,
            ]);
    }

    public function actionShowcase($caseid){
    	$case  = MingruiDoc::findOne($caseid);
    	return $this->render('case-item',[
                'model' => $case,
            ]);
    }

    public function actionClassjson($key){
    	$this->layout = false;
    	$keyword = Yii::$app->request->post('keyword');
    	$query = Information::find()
        	->where([ 'key'=> $key]);

        $query = $query ->andWhere(['like','sick',$keyword]);
        $infolist= $query->all();

        //var_dump($infolist);
        $list = [];
        foreach ($infolist as $key => $info) {
        	 $list[] = ["label"=>$info->sick, 'value'=>$info->sick, 'id'=>$info->id];
        }
        return json_encode($list);

    }


    public function actionSubclass($subclass)
    {    //groupby --$subclass
        $firstOne  =  Information::findOne($subclass);
        if(!$firstOne) {
        	return "查找不到对应的分类";
        }

        $class = $firstOne->class;


        $query = Information::find()
            ->where([ 'class'=> $class]);

        $infolist= $query ->all();

       // echo $query->createCommand()->getRawSql(); exit;
        if(count($infolist) <1) return 'no data!';
        return $this->render('subclass',[
                'infolist' => $infolist,
                'model' => $infolist[0],
                'keywords'=>''
            ]);


    }

    //class 下搜疾病
    public function actionSubclass2($key,$keyword)
    {
        if(!$keyword) return 'keyword is null';

         $query = Information::find()
            ->where([ 'key'=> $key]);

         $keywords = $this->keywordclear($keyword);

         $query = $query ->andWhere(['or like','sick',$keywords]);


        $infolist= $query ->all();

       // echo $query->createCommand()->getRawSql(); exit;
        if(count($infolist) <1) return 'no data!';
        return $this->render('subclass',[
                'infolist' => $infolist,
                'model' => $infolist[0],
                'keywords'=>$keywords
            ]);

    }

    //class 下搜gene
    public function actionSubclass3($key,$gene)
    {
        if(!$gene) return 'gene is null';

         $query = Information::find()
            ->where([ 'key'=> $key]);

         $genelist = $this->keywordclear($gene);

         $query = $query ->andWhere(['in','gene', $genelist]);


        $infolist= $query ->all();

       // echo $query->createCommand()->getRawSql(); exit;
        if(count($infolist) <1) return 'no data!';
        return $this->render('subclass',[
                'infolist' => $infolist,
                'model' => $infolist[0],
                'keywords'=>$genelist
            ]);

    }




    function showSubClass($class, $name_keywords=null)
    {

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

       public function actionSubinfoBygene($gene)
    {
    	$clsModel  =  Information::find()->where(['gene'=>$gene])->one();
    	 if(!$clsModel) {
        	return "查找不到对应的分类";
        }

        return $this->render('info',[
                'model' => $clsModel,
            ]);

    }

    public function keywordclear($keywords){
        $keywords = str_replace('　', ' ', $keywords);
        $keys = array_filter(explode(' ',$keywords));

        foreach ($keys as $k => $value) {
             $keys[$k]=strtoupper($value);
        }
        return $keys;

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
    	$listinfo = [];
    	foreach ($models as   $m) {
    		 $main = $m->main;
             if(!$main) {continue;}
             if(!is_array($list[$main->number]) ){
                $list[$main->number] =[];
             }

    		 $list[$main->number][] = $m->gene;
    		 $listinfo[$main->number] = $main;
    	}
    	$listX=[];
    	foreach ($list as $num => $genelist) {
    		 $listX[] = [
    		 	   'huohao'=>$num,
    		       'genes'=>array_unique($genelist),
    		       'info'=>$listinfo[$num]
    		 ];
    	}

        //$listX = self::my_sort($listX);
         usort($listX,[$this, 'abcd']);
        //var_dump($listX);exit;

    	return $this->render('search-huohao',[
                'list' => $listX,
                'keywords'=>$keywords
            ]);
    }
    public static function abcd($a, $b){
            $c = count($a['genes']);
			$c1 = count($b['genes']);
            if($c1 > $c){
            	 return true;
            }
            return false;
    }
	public static function   my_sort($list){
		for($i=0; $i<count($list)-1; $i++){
			$c = count($list[$i]['genes']);
			$c1 = count($list[$i+1]['genes']);
            if($c1 > $c){
            	$tmp = $list[$i];
            	$list[$i] = $list[$i+1];
            	$list[$i+1] = $tmp;
            }

		}
	   return $list;
	}


    //搜症状-->gene
    public function actionSearch($keywords){

    	$keywordlist = $this->keywordclear($keywords);


    	$models = Chpo::find()
        ->where(['or like','chpo', $keywordlist ])
        ->orderBy('rote DESC')
        ->all();
    	return $this->render('searchsick',[
                'models' => $models,
                'type'=>'gene',
                'keywords'=>$keywordlist
            ]);
    }
    //gene-->症状
    public function actionSearchgene($keywords){
    	$models = Chpo::find()->where(['like','gene',$keywords])->all();
    	return $this->render('searchsick',[
                'models' => $models,
                'type'=>'zhengzhuang',
                'keywords'=>$keywords
            ]);
    }



}

