<?php

namespace backend\controllers;

use backend\models\MingruiPingjia;
use backend\models\MingruiPingjiaResearch;
use backend\models\RestReport;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PingjiaController implements the CRUD actions for MingruiPingjia model.
 */
class PingjiaController extends Controller
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
     * Lists all MingruiPingjia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new MingruiPingjiaResearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MingruiPingjia model.
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
     * Creates a new MingruiPingjia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MingruiPingjia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

/**
 * Updates an existing MingruiPingjia model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param string $id
 * @return mixed
 */
    public function actionSaveXingji()
    {
        $reportid   = Yii::$app->request->post('report_id');
        $pingjia    = Yii::$app->request->post('pingjia');
        $pingjiaDiy = Yii::$app->request->post('pingjiaDiy');
        $linchuang  = Yii::$app->request->post('linchuang');
        if (!$reportid || !($pingjia || $linchuang)) {
            return;
        }
        $model = MingruiPingjia::find()->where(['report_id' => $reportid])->one();
        if (!$model) {
            $model            = new MingruiPingjia();
            $model->report_id = $reportid;
            $report           = RestReport::findOne($reportid);
            if (!$report) {
                return "report id={$reportid} not exist";
            }
            $model->sample_id = $report->sample_id;
        }
        if ($pingjia) {
            $model->pingjia = $pingjia;
            if ($pingjiaDiy) {
                $model->pingjiaDiy = $pingjiaDiy;
            }
        }

        if ($linchuang) {
            $val              = $linchuang == 'null' ? '' : $linchuang;
            $model->linchuang = $val;
        }

        if ($model->save()) {
            echo json_encode(['code' => 1, 'msg' => 'ok']);
        } else {
            var_export($model->errors);
        }

    }

    /**
     * Updates an existing MingruiPingjia model.
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
     * Deletes an existing MingruiPingjia model.
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
     * Finds the MingruiPingjia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MingruiPingjia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MingruiPingjia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
