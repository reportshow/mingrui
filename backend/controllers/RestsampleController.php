<?php

namespace backend\controllers;

use backend\models\RestSample;
use backend\models\RestClient;
use backend\models\RestSampleSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RestSampleController implements the CRUD actions for RestSample model.
 */
class RestsampleController extends Controller
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
     * Lists all RestSample models.
     * @return mixed
     */
    public function actionIndex($old = '')
    {
        $searchModel = new RestSampleSearch();
        $params      = Yii::$app->request->queryParams;

        $query = RestSampleSearch::find();
/*        if ($old == 'yes') {
            $time = getdate();
            $t    = ($time['year'] - 1) . '-' . $time['mon'] . '-1';
             
            $query = $query->where(['<', 'created', $t]);
        }*/

        if (Yii::$app->user->can('doctor')) {
            $mobile = Yii::$app->user->Identity->username;
            $doctor = RestClient::find()->where(['tel' => $mobile])->one();    
            if(!$doctor){
               return "医生资料未找到";
            }
            $query = $query->where(['xianzhengzhe'=>1]);
            $query = $query->andWhere(['doctor_id' => $doctor->id]);
            //echo $query->createCommand()->getRawSql(); exit;
        }

        $query = $query->orderBy('sample_id DESC');

        $dataProvider = $searchModel->search($params, $query);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


/**
     * Lists all RestSample models.
     * @return mixed
     */
    public function actionIndexReport($old = '')
    {
        $searchModel = new RestSampleSearch();
        $params      = Yii::$app->request->queryParams;

        $query = RestSampleSearch::find();
        $query = $query->where(['xianzhengzhe'=>1]);

/*        if ($old == 'yes') {
            $time = getdate();
            $t    = ($time['year'] - 1) . '-' . $time['mon'] . '-1';
             
            $query = $query->where(['<', 'created', $t]);
        }
*/
        if (Yii::$app->user->can('doctor')) {
            $role_id = Yii::$app->user->Identity->role_tab_id;
         /*   $doctor = RestClient::find()->where(['tel' => $mobile])->one();    
            if(!$doctor){
               return "医生资料未找到";
            }*/
            $query = $query->andWhere(['doctor_id' => $role_id]);
            //echo $query->createCommand()->getRawSql(); exit;
        }

        $query = $query->orderBy('sample_id DESC');

        $dataProvider = $searchModel->search($params, $query);

        return $this->render('index-report', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RestSample model.
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
     * Creates a new RestSample model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RestSample();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sample_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RestSample model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sample_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RestSample model.
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
     * Finds the RestSample model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RestSample the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RestSample::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
