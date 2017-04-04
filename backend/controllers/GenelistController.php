<?php

namespace backend\controllers;

use Yii;
use apps\models\Mainlist;
use apps\models\MainlistSearch;
use apps\models\Information;

use backend\models\MingruiDoc;
use backend\models\MingruiDocSearch;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

/**
 * GenelistController implements the CRUD actions for Mainlist model.
 */
class GenelistController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /*
    public function beforeAction($action){ 
    	if(!Yii::$app->user->can('admin')){  
    		$url = '../../apps/web/index.php?r=gene/index'  ;
    		return "<script> location.href = '$url';</script>";
    		return;
    	}
    }*/

    /**
     * Lists all Mainlist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MainlistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mainlist model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mainlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mainlist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id'           => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mainlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id'           => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
   
    public static $genecase ='genecase';
    public function actionCasedelete($classid, $caseid){ 
    	$main = $this->findModel($classid);
    	$caselist = explode(',', $main->caselist);
    	$caselist= array_flip($caselist);
    	unset($caselist[$caseid]);
    	$caselist= array_flip($caselist);
    	$main->caselist = join(',', $caselist);
        $main->save();
   
        MingruiDoc::findOne($caseid)->delete();
        return $this->redirect(['case', 'classid' => $classid]); 


    }
    public function actionCreatecase($classid){ 
        $main = $this->findModel($classid);
        $doc = new MingruiDoc();
        $doc->uid = Yii::$app->user->id;
        $doc->type='genecase';
        $doc->title = '标题';
        $doc->description ='基因案例内容';
        $doc->save(); 

        $caselist = explode(',', $main->caselist);
        $caselist[] = $doc->id;

        $main->caselist = join(',', $caselist);
        $main->save();
       

        return $this->redirect(['mingrui-doc/update', 'id' => $doc->id, 'type'=>self::$genecase]); 


    }
    public function actionCase($classid){  
   	    $_GET['type'] =$type= 'genecase';

        $main = $this->findModel($classid);

        $searchModel = new MingruiDocSearch();
        $params      = Yii::$app->request->queryParams;

        $query = MingruiDoc::find();

        $query = $query->where(['in' , 'id',  explode(',',$main->caselist) ]);

        $query = $query
            ->orderBy('id DESC');
         

        $dataProvider = $searchModel->search($params, $query);

        return $this->render('case-index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

   /**
     * Updates an existing Mainlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionSubupload($id)
    {
        $model = $this->findModel($id);
        $new = new Mainlist(); 

        if ($new->load(Yii::$app->request->post()) ) {
        	$model->classname = $new->classname;
        	if(empty($model->classname) || !$model->classname){ 
               return "key不能为空！！";
        	}
        	$model->save(); 
        	 
			//清除所有同类
	    	Information::deleteAll(['key'=>$model->classname]);

        	self::saveCSV($model);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('subupload', [
                'model' => $model,
            ]);
        }
    }

    function saveCSV($model){ 
     
      set_time_limit(600);
       
       echo "<meta charset='UTF-8'> <div id='listbox' style='margin-left:50px; height:500px;width:600px;overflow:auto'>";
       echo "<script>  function scrollbottom(){var objDiv = document.getElementById('listbox');objDiv.scrollTop = objDiv.scrollHeight;} 
        setInterval(scrollbottom,200);</script>";

		$imageupList = UploadedFile::getInstances($model, 'detail');
		$id = $model->id;
		$key = $model->classname;

		$path = 'upload/genelist/'.$key .$id.'.csv';
		$imageupList[0]->saveAs($path);
      
        $FIELDS = ['class','genecount','sick','sick_en','gene','method','omim','background','wide','DM','refseq'];
        $row = 1;
		$handle = fopen($path,"r");
		$data = fgetcsv($handle, 1000, ","); //ir
		while ($data = fgetcsv($handle, 1000, ",")) {
		    $num = count($data); 
		    $row++;
		    $model = new Information();
		    $model->key = $key;
		    foreach ($FIELDS as $i => $field) {
		    	 $val = trim(iconv('gbk//IGNORE','utf-8',   $data[$i]));
		    	 $model->$field =  $val;
		    } 
		    $model->save();
		    echo   $row .': ' . $model->gene  .' -- ' . $model->sick  . "<br>"; ob_flush();flush();

		}
		fclose($handle);
		echo "</div> <h1>完成！！！</h1>";


    }

    /**
     * Deletes an existing Mainlist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mainlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Mainlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mainlist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDetailview($id){ 
    	 $model = $this->findModel($id);

    	 return $this->render('detailedit', [ 'model' => $model, 'onlyshow'=>true]);
    }
    public function actionDetailedit($id){ 
    	 $model = $this->findModel($id);
    	
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['detailview', 'id' => $model->id]);
        } else {
            return $this->render('detailedit', [
                'model' => $model,
            ]);
        } 

    }
}
