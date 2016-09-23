<?php

namespace backend\controllers;

use backend\models\MingruiMypic;
use backend\models\MingruiMypicSearch;
use backend\models\SaveImage;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MingruiMypicController implements the CRUD actions for MingruiMypic model.
 */
class MingruiMypicController extends Controller
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
     * Lists all MingruiMypic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new MingruiMypicSearch();
        $param = Yii::$app->request->queryParams;
        $query = MingruiMypic::find();
        $query = $query
            ->where(['uid'=>Yii::$app->user->id])
            ->orderBy('id DESC');

        $dataProvider = $searchModel->search($param, $query);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MingruiMypic model.
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
     * Creates a new MingruiMypic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MingruiMypic();

        if ($model->load(Yii::$app->request->post())) {
            $model->createtime = time();
            $model->uid = Yii::$app->user->id;
            $model->images     = 'tosave';
            if (!$model->save()) {
                var_export($model->errors);exit;
            }
            SaveImage::save($model, 'images');

            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MingruiMypic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->createtime = time();
            if ($model->save()) {
                SaveImage::save($model, 'images');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                var_export($model->errors);exit;

                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MingruiMypic model.
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
     * Finds the MingruiMypic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MingruiMypic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MingruiMypic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
