<?php

namespace backend\controllers;

use backend\models\MingruiVcf;
use backend\models\MingruiVcfSearch;
use backend\models\SaveImage;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\components\SMS;
use backend\models\Genetypes;

/**
 * VcfController implements the CRUD actions for MingruiVcf model.
 */
class VcfController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MingruiVcf models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new MingruiVcfSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MingruiVcf model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
         $model = $this->findModel($id);
         $datas='';
         if($model->task_id >= 0) {
              $vcf_url = Yii::$app->params['vcfservice'] . '/api/task/result/' . $model->task_id;
              $datas = file_get_contents($vcf_url);
         }

         $datas = json_decode($datas, true);
         if($datas == NULL) {
              $datas= [];
         }
             
        foreach ($datas as $key => $data) {
            $str = $datas[$key][2];
            $ret = preg_match('/.*-([0-9]+).*/', $data[1], $matches);
            if ($ret) {
                $types = Genetypes::find()->where(['startcoord' => $matches[1]])->one();
                if ($types) {
                    $datas[$key][] = $str . '<br/>' . $types->disease . '<br/>' . $types->descr;
                } else {
                    $datas[$key][] = $str;
                }
            } else {
                $datas[$key][] = $str;
            }
        }
        $data = json_encode($datas);
        
        return $this->render('view', [
                                   'model' => $model,
                                   'data'  => $data
                                   ]);
    }

    public function actionDownload($id)
    {
        $vcf      = MingruiVcf::findOne($id);
        $filename = $vcf->vcf;
        header('Content-type: application/octet-stream');
        header('Content-Length:' . filesize($filename));
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

        readfile($filename);
    }
    /**
     * Creates a new MingruiVcf model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MingruiVcf();

        if ($model->load(Yii::$app->request->post())) {
            //$model->createtime = time();
            $model->uid = Yii::$app->user->id;
            $model->vcf = 'tosave';
            if (!$model->save()) {
                var_export($model->errors);exit;
            }
            SaveImage::save($model, 'vcf');
            
            //create annotate task on remote server
            $vcf_url = Yii::$app->params['vcfservice'] . '/api/task/new';
            $file = json_decode($model->vcf, true)[0];
            $file_name_with_full_path = realpath(getcwd() . '/' . $file['path']);
            $task_id = $this->postFile($vcf_url, 'file', $file['name'], $file_name_with_full_path);
            if(strcmp($task_id, 'error')){
                 $model->task_id = $task_id;
                 $model->save();
            }

            
            $this->sendNotice();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function sendNotice()
    {
        $mobile = Yii::$app->params['master_vcf_mobile'];
        $voice  = Yii::$app->params['master_vcf_voice'];

       //  SMS::landingCall($voice, $mobile);
    }
    /**
     * Updates an existing MingruiVcf model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MingruiVcf model.
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
     * Finds the MingruiVcf model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MingruiVcf the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MingruiVcf::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function postFile($url, $key, $file_name, $file)
    {    
         $eol = "\r\n"; //default line-break for mime type
         $BOUNDARY = md5(time());
         $BODY="";
         $BODY.= '--'.$BOUNDARY. $eol;
         $BODY.= 'Content-Disposition: form-data; name="'.$key.'"; filename="'.$file_name.'"'. $eol ;
         $BODY.= 'Content-Type: application/octet-stream' . $eol;
         $BODY.= 'Content-Transfer-Encoding: base64' . $eol . $eol;
         $BODY.= chunk_split(base64_encode(file_get_contents($file))) . $eol;
         $BODY.= '--'.$BOUNDARY .'--' . $eol. $eol;

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                          "Content-Type: multipart/form-data; boundary=".$BOUNDARY)
              );
         curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/1.0 (Windows NT 6.1; WOW64; rv:28.0) Gecko/20100101 Firefox/28.0');
         curl_setopt($ch, CURLOPT_URL, $url);

         curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // call return content
         curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_POST, true); //set as post
         curl_setopt($ch, CURLOPT_POSTFIELDS, $BODY); // set our $BODY
         $response = curl_exec($ch); // start curl navigation
         
         return $response;
    }
         
}
