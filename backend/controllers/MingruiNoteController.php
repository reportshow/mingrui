<?php

namespace backend\controllers;

use backend\models\MingruiNotes;
use backend\models\MingruiNoteSearch;
use backend\models\SaveImage;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MingruiNoteController implements the CRUD actions for MingruiNotes model.
 */
class MingruiNoteController extends Controller
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
     * Lists all MingruiNotes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MingruiNoteSearch();
        $param       = Yii::$app->request->queryParams;
        $query       = MingruiNotes::find();
        $query       = $query
            ->where(['uid' => Yii::$app->user->id])
            ->orderBy('id DESC');

        $dataProvider = $searchModel->search($param, $query);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MingruiNotes model.
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
     * Creates a new MingruiNotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MingruiNotes();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = 'tosave';
            $model->uid   = Yii::$app->user->id;
            if ($model->type == 'voice') {
                $voices = json_decode($model->voice);
                foreach ($voices as $key => $voice) {
                    $path   = $model->voicePath($voice);
                    $result = Yii::$app->wechat->getMedia($voice->serverId);
                    if ($result) {
                        //exit( $path);
                        file_put_contents($path, $result);
                    }
                }
            }

            if (!$model->save()) {
                var_export($model->errors);exit;
            }
            SaveImage::save($model, 'image');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MingruiNotes model.
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
     * Deletes an existing MingruiNotes model.
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
     * Finds the MingruiNotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MingruiNotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MingruiNotes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
