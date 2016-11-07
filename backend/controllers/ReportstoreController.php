<?php

namespace backend\controllers;

use backend\models\MingruiReportstore;
use backend\models\MingruiReportstoreResearch;
use backend\models\SaveImage;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ReportstoreController implements the CRUD actions for MingruiReportstore model.
 */
class ReportstoreController extends Controller
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
     * Lists all MingruiReportstore models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MingruiReportstoreResearch();
        $params      = Yii::$app->request->queryParams;
        $query       = MingruiReportstore::find();
        if (!Yii::$app->user->can('admin')) {
            $query = $query->where(['uid' => Yii::$app->user->id]);
        }
        $dataProvider = $searchModel->search($params, $query);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MingruiReportstore model.
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
     * Displays a single MingruiReportstore model.
     * @param string $id
     * @return mixed
     */
    public function actionViewreport($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $attachements = json_decode($model->attachements);
            if (is_array($attachements)) {
                $count = count($attachements);
                if ($count == 0) {
                    return "<h1>没有报告文件</h1>";
                } else if ($count == 1) {
                    $att = $attachements[0];

                    if ($att) {
                        header('Location: ' . $att->path);exit;
                    } else {
                        return "没有报告文件";
                    }

                } else if ($count > 1) {

                    return "xxxxxx";
                }
            } else {
                return "没有报告文件";
            }

        } else {
            return "没有报告文件";
        }

    }
/**
 * Creates a new MingruiReportstore model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 * @return mixed
 */
    public function actionCreate()
    {
        $model = new MingruiReportstore();

        if ($model->load(Yii::$app->request->post())) {
            $model->uid          = Yii::$app->user->id;
            $model->attachements = '[]';
            if (!$model->save()) {
                var_export($model->errors);
            }
            SaveImage::save($model, 'attachements');

            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

/**
 * Updates an existing MingruiReportstore model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param string $id
 * @return mixed
 */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            // $model->uid          = Yii::$app->user->id;
            $model->attachements = '[]';
            if (!$model->save()) {
                var_export($model->errors);
            }
            SaveImage::save($model, 'attachements');

            return $this->redirect(['index', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

/**
 * Deletes an existing MingruiReportstore model.
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
 * Finds the MingruiReportstore model based on its primary key value.
 * If the model is not found, a 404 HTTP exception will be thrown.
 * @param string $id
 * @return MingruiReportstore the loaded model
 * @throws NotFoundHttpException if the model cannot be found
 */
    public function findModel($id)
    {
        if (($model = MingruiReportstore::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
