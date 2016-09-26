<?php

namespace backend\controllers;

use backend\models\Geneareas;
use backend\models\GeneDiseases;
use backend\models\Genetypes;
use backend\models\MingruiComments;
use backend\models\RestClient;
use backend\models\RestReport;
use backend\models\RestReportSearch;
use backend\models\RestSample;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RestReportController implements the CRUD actions for RestReport model.
 */
class RestReportController extends Controller
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

    public function actionSearch()
    {
        $searchModel = new RestReportSearch();
        $params      = Yii::$app->request->queryParams;
        //$params['RestReportSearch']['rest_report.status'] = 'finished';

        $query = RestReport::find();
        $query = $query
            ->where(['<>', 'ptype', 'yidai'])
            ->andWhere(['rest_report.status' => 'finished']);

        $dataProvider = $searchModel->search($params, $query);

        return $this->render('search', [
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Lists all RestReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestReportSearch();
        $params      = Yii::$app->request->queryParams;
        //$params['RestReportSearch']['rest_report.status'] = 'finished';

        $query = RestReport::find();
        $query = $query->where(['<>', 'ptype', 'yidai']);

        $unfinished = Yii::$app->request->get('unfinished');
        if (!empty($unfinished)) {
          //未出报告
            $query = $query->andWhere(['<>', 'rest_report.status', 'finished']);
        } else {
            $query = $query->andWhere(['rest_report.status' => 'finished']);
        }

        if (Yii::$app->user->can('doctor')) {
            $mobile = Yii::$app->user->Identity->username;
            $doctor = RestClient::find()->where(['tel' => $mobile])->one();
            if (!$doctor) {
                return "医生资料未找到";
            }
            $query = $query->joinWith(['sample']);

            $query = $query->where(['rest_sample.doctor_id' => $doctor->id]);
            //echo $query->createCommand()->getRawSql(); exit;
        } else if (Yii::$app->user->can(  'admin')) {
              
        }else if (Yii::$app->user->can( 'guest')) {
            return "你没有权限查看本页";
        }

        $dataProvider = $searchModel->search($params, $query);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMyreport()
    {
        //var_export(Yii::$app->user);exit;
        $mobile = Yii::$app->user->Identity->username;
        $query  = RestSample::find()->where(['like', "REPLACE(tel1,' ','')", $mobile]);
        $smp    = $query->one(); //有多个
        if (!$smp) {
            return '没找到报告' . $query->createCommand()->getRawSql();
        }
        $reports = $smp->restReports; //多个报告
        if (is_array($reports) && count($reports) > 0) {
            $rpt = $reports[0];
            return $this->render('view-guest', [
                'model'    => $rpt,
                'comments' => $this->getComments($rpt->id),
            ]);
        }

    }

    /**
     * Displays a single RestReport model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $viewname = 'view';

        if (Yii::$app->user->can('admin')) {
            $viewname = 'view';
        } else if (Yii::$app->user->can('doctor')) {
            $viewname = 'view';
        } else {
            $viewname = 'view-guest';
        }

        $userdata = $this->findModel($id);

        $cnv_array     = json_decode($userdata->cnvsave, true);
        $user_cnv_gene = '';
        foreach ($cnv_array as $key => $data) {
            $user_cnv_gene = $data[2];
        }

        $str_diseases = "";
        $diseases     = GeneDiseases::find()->where(['gene' => $user_cnv_gene])->one();
        if ($diseases) {
            $temp           = $diseases->diseases;
            $array_diseases = explode('|', $temp);
            foreach ($array_diseases as $disease) {
                $str_diseases .= $disease . '<br>';
            }
        } else {
            $str_diseases = "";
        }

        return $this->render($viewname, [
            'model'    => $userdata,
            'comments' => $this->getComments($id),
            'diseases' => $str_diseases,
        ]);
    }

/**
 * Displays a single RestReport model.
 * @param integer $id
 * @return mixed
 */
    public function actionSendComment($id)
    {
        $model = new MingruiComments();
        $model->load(Yii::$app->request->post());
        $model->uid = Yii::$app->user->id;

        if ($model->save()) {
            //return $this->redirect(['view', 'id' => $id]);
            $url = \Yii::$app->request->headers['Referer'];
            header("Location: $url");
            echo "<script>location.href='$url';</script>";
            exit;
        } else {
            var_dump($model->errors);
        }
    }

    /**
     * Displays a single RestReport model.
     * @param integer $id
     * @return mixed
     */
    public function actionShowReport($id)
    {
        return $this->render('showreport', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RestReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RestReport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RestReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing RestReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function getComments($id)
    {
        $comments = MingruiComments::find()
            ->where(['report_id' => $id])
            ->joinWith(['creator'])
            ->all();
        /* foreach ($comments as $cmt ) {

        }*/

        return $comments;
    }

    public function actionAnalyze($id)
    {
        $model     = $this->findModel($id);
        $sqliteUrl = str_replace('/primerbean/media/', 'user/', $model->snpsqlite);
        $sqliteUrl = Yii::$app->params['erp_url'] . $sqliteUrl;
        $datas     = file_get_contents($sqliteUrl);
        $datas     = json_decode($datas, true);
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

        return $this->render('analyze', [
            'model' => $model,
            'data'  => $data,
        ]);
    }

    public function actionStats($id)
    {
        //1. find user's bad gene
        $userdata       = $this->findModel($id);
        $cnv_array      = json_decode($userdata->cnvsave, true);
        $user_cnv_gene  = '';
        $user_cnv_areas = [];
        foreach ($cnv_array as $key => $data) {
            $user_cnv_gene  = $data[2];
            $user_cnv_areas = $data[4];
        }

        //2. find all areas of this gene
        $final_areas = [];
        if (!empty($user_cnv_gene)) {
            $areas = Geneareas::find()->where(['geneareas.gene' => trim($user_cnv_gene)])->all();

            foreach ($areas as $area) {
                $final_areas[] = ['start' => $area->startcoord,
                    'end'                     => $area->endcoord,
                    'count'                   => $area->report_count,
                    'bad'                     => false,
                ];
            }

            foreach ($user_cnv_areas as $user_cnv_area) {
                $final_areas[$user_cnv_area - 1]['bad'] = true;
            }
        }

        return $this->render('stats', [
            'gene'    => $user_cnv_gene,
            'summary' => $userdata->explainsummary,
            'data'    => json_encode($final_areas),
            'model'   => $this->findModel($id),
        ]);
    }

    /* //import gene areas data to DB */
    /* public function actionImportgeneareas() */
    /* { */
    /*      $handle=fopen("geneareas.csv","r"); */
    /*      while($data=fgetcsv($handle,0,",")){ */
    /*           $gene = $data[0]; */
    /*           $count = $data[1]; */
    /*           $starts = explode(',', $data[2]); */
    /*           $ends = explode(',', $data[3]); */
    /*           for($i=0;$i<$count;$i++){ */
    /*                $area = new Geneareas; */
    /*                $area->gene = $gene; */
    /*                $area->startcoord = $starts[$i]; */
    /*                $area->endcoord = $ends[$i]; */
    /*                $area->save(); */
    /*           } */
    /*      } */
    /*      echo "OK"; */
    /* } */

    /* //import gene types data to DB */
    /* public function actionImportgenetypes() */
    /* {  */
    /*      $handle=fopen("genetypes.csv","r"); */
    /*      while($data=fgetcsv($handle,0,",")){ */
    /*           $type = new Genetypes; */
    /*           $type->startcoord = $data[0]; */
    /*           $type->endcoord = $data[1]; */
    /*           $type->gene = $data[2]; */
    /*           $type->tag = $data[3]; */
    /*           $type->descr = $data[4]; */
    /*           $type->hgvs = $data[5]; */
    /*           $type->disease = $data[6]; */
    /*           $type->save(); */
    /*      } */
    /*      echo "OK"; */
    /* } */

    /* //calculate the report count of each gene area */
    /* public function actionGenecal() */
    /* { */
    /*      $types = Genetypes::find()->all(); */
    /*      foreach($types as $type) { */
    /*           echo $type->gene; */
    /*           $areas = Geneareas::find()->where(['geneareas.gene' => trim($type->gene)])->all(); */
    /*           foreach($areas as $area){ */
    /*                if($type->startcoord >= $area->startcoord and $type->startcoord <= $area->endcoord){ */
    /*                     $area->report_count = $area->report_count + 1; */
    /*                     $area->save(); */
    /*                } */
    /*           } */
    /*      } */
    /*      echo "OK"; */
    /* } */

    /* //import gene types data to DB */
    /* public function actionImportgenediseases() */
    /* { */
    /*      $handle=fopen("gene_disease.csv","r"); */
    /*      while($data=fgetcsv($handle,0,",")){ */
    /*           $gd = new GeneDiseases; */
    /*           $gd->gene = $data[0]; */
    /*           $gd->diseases = $data[1]; */
    /*           $gd->save(); */
    /*      } */
    /*      echo "OK"; */
    /* } */

    //import gene areas data to DB
    public function actionImportgeneareas()
    {
        /* $handle=fopen("geneareas.csv","r"); */
        /* while($data=fgetcsv($handle,0,",")){ */
        /*      $gene = $data[0]; */
        /*      $count = $data[1]; */
        /*      $starts = explode(',', $data[2]); */
        /*      $ends = explode(',', $data[3]); */
        /*      for($i=0;$i<$count;$i++){ */
        /*           $area = new Geneareas; */
        /*           $area->gene = $gene; */
        /*           $area->startcoord = $starts[$i]; */
        /*           $area->endcoord = $ends[$i]; */
        /*           $area->save(); */
        /*      } */
        /* } */
        echo "OK";
    }

    //import gene types data to DB
    public function actionImportgenetypes()
    {
        /* $handle=fopen("genetypes.csv","r"); */
        /* while($data=fgetcsv($handle,0,",")){ */
        /*      $type = new Genetypes; */
        /*      $type->startCoord = $data[0]; */
        /*      $type->endCoord = $data[1]; */
        /*      $type->gene = $data[2]; */
        /*      $type->tag = $data[3]; */
        /*      $type->descr = $data[4]; */
        /*      $type->hgvs = $data[5]; */
        /*      $type->vartype = $data[6]; */
        /*      $type->save(); */
        /* } */
        echo "OK";
    }

    //calculate the report count of each gene area
    public function actionGenecal()
    {
        /* $types = Genetypes::find()->all(); */
        /* foreach($types as $type) { */
        /*      echo $type->gene; */
        /*      $areas = Geneareas::find()->where(['geneareas.gene' => trim($type->gene)])->all(); */
        /*      foreach($areas as $area){ */
        /*           if($type->startCoord >= $area->startcoord and $type->startCoord <= $area->endcoord){ */
        /*                $area->count = $area->count + 1; */
        /*                $area->save(); */
        /*           } */
        /*      } */
        /* } */
        echo "OK";
    }

    // public function
    /**
     * Finds the RestReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RestReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RestReport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
