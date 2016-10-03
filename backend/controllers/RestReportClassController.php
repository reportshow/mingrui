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
use backend\models\VoiceRecord;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\widgets\Nodata;
/**
 * RestReportController implements the CRUD actions for RestReport model.
 */
class RestReportClassController extends Controller
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
        $query = $query->where(['<>', 'ptype', 'yidai']);/*
        $query = $query->andWhere(['not like', 'name', '之父']);
        $query = $query->andWhere(['not like', 'name', '之母']);*/
 

        if (Yii::$app->user->can('doctor')) {
            $doctor = Yii::$app->user->Identity->doctor;              
            $query = $query->joinWith(['sample']);
            $query = $query->where(['rest_sample.doctor_id' => $doctor->id]);
            //echo $query->createCommand()->getRawSql(); exit;
        } else if (Yii::$app->user->can('admin')) {

        } else if (Yii::$app->user->can('guest')) {
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
            return Nodata::widget(['message' => '没有与您相关的报告记录']);
            //return '没找到报告' . $query->createCommand()->getRawSql();
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

        $userdata       = $this->findModel($id);
        $user_snp_genes = [];
        $snp_array      = json_decode($userdata->snpsave, true);
        foreach ($snp_array as $key => $data) {
            $user_snp_genes[] = $data[0];
        }

        $gene_diseases = [];
        foreach ($user_snp_genes as $gene) {
            $str_diseases = "";
            $diseases     = GeneDiseases::find()->where(['gene' => $gene])->one();
            if ($diseases) {
                $temp           = $diseases->diseases;
                $array_diseases = explode('|', $temp);
                foreach ($array_diseases as $disease) {
                    $str_diseases .= $disease . '<br>';
                }
            } else {
                $str_diseases = "";
            }
            $gene_diseases[] = [$gene => $str_diseases];
        }

        return $this->render($viewname, [
            'model'    => $userdata,
            'comments' => $this->getComments($id),
            'diseases' => $gene_diseases,
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

        if (json_decode($model->content)) {
            $voices = VoiceRecord::saveRecordVoice($model->content);
        }

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
        /* //data for fast debug */
        /* $datas = '[["ABCB1", "c.2677T>A chr7-87160618 p.S893T", "DP", "Lung cancer, lower risk, association with", "Ser893Thr", "nonsynonymous", [null, null, 0.0366178], "Gervasini.Cancer,107,2850,2006(17120199)", "Damaging(0.03)", "Benign(0.001)", "Benign(0.997)", "Polymorphism(3.72)", "Conserved(3.72)", "het", ["NM_000927", "exon22"], {"NG16070026": ["het", "85/93(0.52)"]}, [1, 0, "AD"], 1, 0, "4383", ["\u4e0d\u660e"], [["\u79cb\u6c34\u4ed9\u78b1\u6297\u6027", "\u4e0d\u660e", "\u4e0d\u660e"], ["\u708e\u6027\u80a0\u75c513\u578b", "\u4e0d\u660e", "\u4e0d\u660e"]]], ["ABCC8", " chr11-17417496 ", "DM?", "Hypoglycaemia, persistent hyperinsulinaemic", "IVS33 as C-T -19", "unknown", [0.03, 0.010768, null], "Fernandez-Marmiesse.Human mutation,27,214,2006(16429405)", null, null, null, null, null, "het", ["", ""], {"NG16070026": ["het", "63/53(0.46)"]}, [1, 0, "AD"], 0, 1, "5605", ["\u4e0d\u660e", "AD"], [["\u7cd6\u5c3f\u75c5", "AD", "\u65e0"], ["\u7cd6\u5c3f\u75c5", "AD", "\u65e0"], ["\u7cd6\u5c3f\u75c5", "\u4e0d\u660e", "\u65e0"]]], ["ACAT1", "c.436-4G>A chr11-108009621 splicing", "", "", "", "splicing", [0.01, 0.000385, null], null, null, null, null, null, null, "het", ["NM_000019", "exon6"], {"NG16070026": ["het", "95/96(0.50)"]}, [1, 0, "AD"], 0, 2, "1622", ["AR"], [["Beta\u786b\u89e3\u9176\u7f3a\u4e4f\u75c7", "AR", "\u6709\u4e2d\u7b49\uff0c\u5927\u7247\u6bb5\u7f3a\u5931"]]], ["ADAMTSL4", "c.926G>A chr1-150526393 p.R309Q", "DM?", "Ectopia lentis, isolated form", "Arg309Gln", "nonsynonymous", [0.04, 0.001387, 0.0163116], "Aragon-Martin.Human mutation,31,E1622,2010(20564469)", "Tolerable(0.36)", "Benign(0.18)", "Benign(1)", "Polymorphism(2.29)", "Conserved(2.29)", "het", ["NM_001288607", "exon6"], {"NG16070026": ["het", "126/114(0.47)"]}, [1, 0, "AD"], 0, 3, "3729", ["AR"], [["\u6676\u72b6\u4f53\u53ca\u77b3\u5b54\u5f02\u4f4d", "AR", "\u6076\u6027\u7a81\u53d8\u4e3a\u4e3b"], ["\u5355\u7eaf\u6676\u72b6\u4f53\u5f02\u4f4d", "AR", "\u6076\u6027\u7a81\u53d8\u4e3a\u4e3b"]]]]'; */
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

        return $this->render('analyze', [
            'model' => $model,
            'data'  => $data,
        ]);
    }

    public function actionStats($id)
    {
        //1. find user's bad gene
        $userdata  = $this->findModel($id);
        $snp_array = json_decode($userdata->snpsave, true);

        $user_snp_genes = []; //name areas[]
        $user_snp_areas = [];
        foreach ($snp_array as $key => $data) {
            $user_snp_genes[] = $data[0];
        }

        //2. find all areas of this gene
        $final_areas = [];
        if (!empty($user_snp_genes[0])) {
            $areas = Geneareas::find()->where(['geneareas.gene' => trim($user_snp_genes[0])])->all();

            foreach ($areas as $area) {
                $final_areas[] = ['start' => $area->startcoord,
                    'end'                     => $area->endcoord,
                    'count'                   => $area->report_count,
                    'bad'                     => false,
                ];
            }

            /* foreach ($user_snp_areas as $user_snp_area) { */
            /*     $final_areas[$user_snp_area - 1]['bad'] = true; */
            /* } */
        }

        return $this->render('stats', [
            'gene'    => empty($user_snp_genes)? null : $user_snp_genes[0],
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
