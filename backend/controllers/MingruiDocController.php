<?php

namespace backend\controllers;

use backend\models\MingruiComments;
use backend\models\MingruiDoc;
use backend\models\MingruiDocSearch;
use backend\models\SaveImage;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MingruiDocController implements the CRUD actions for MingruiDoc model.
 */
class MingruiDocController extends Controller
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
     * Lists all MingruiDoc models.
     * @return mixed
     */
    public function actionIndex($type)
    {
        $searchModel = new MingruiDocSearch();
        $params      = Yii::$app->request->queryParams;

        $query = MingruiDoc::find();
        if($type=='article'){
            $query = $query->where(['doc'=>'']);
        }else if($type=='doc'){
             $query = $query->where(['<>','doc', '']);
        }
        $query = $query
            ->orderBy('id DESC');
  //echo $query->createCommand()->getRawSql(); exit;

        $dataProvider = $searchModel->search($params, $query);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MingruiDoc model.
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
     * Creates a new MingruiDoc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MingruiDoc();

        if ($model->load(Yii::$app->request->post())) {
            $model->uid = Yii::$app->user->id;
            $model->doc = '';
            if (!$model->save()) {
                var_export($model->errors);
            }
            //var_export($model);exit;

            SaveImage::save($model, 'doc');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
            $id = substr($id, 3);
            return $this->redirect(['view', 'id' => $id]);
        } else {
            var_dump($model->errors);
        }
    }

    /**
     * Updates an existing MingruiDoc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                var_export($model->errors);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MingruiDoc model.
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
     * Finds the MingruiDoc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MingruiDoc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MingruiDoc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
