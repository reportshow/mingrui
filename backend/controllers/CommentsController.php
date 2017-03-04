<?php

namespace backend\controllers;

use Yii;
use backend\models\MingruiComments;
use backend\models\MingruiCommentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentsController implements the CRUD actions for MingruiComments model.
 */
class CommentsController extends Controller
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

    /**
     * Lists all MingruiComments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MingruiCommentsSearch();
 
        $typeOp =  'like';

        $query = MingruiComments::find() 
	        ->where([$typeOp,'report_id','gb'])
	        ->andWhere(['<>','uid' ,'6'])
	         ->andWhere(['isread'=>0])
	        //->groupby('report_id')
	        ->orderby('id desc');

	    $query2 = MingruiComments::find() 
	        ->where([$typeOp,'report_id','gb']) 
	        // ->andWhere(['isread'=>1])
	         ->groupby('report_id')
	        ->orderby('id desc');


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);

        $dataProviderRead = $searchModel->search(Yii::$app->request->queryParams,$query2);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderRead'=> $dataProviderRead,
        ]);
    }


    public function actionReports()
    {
        $searchModel = new MingruiCommentsSearch();
 
        $typeOp =   'not like'  ;

        $query = MingruiComments::find() 
	        ->where([$typeOp,'report_id','gb'])
	        ->andWhere(['<>','uid' ,'6'])
	         ->andWhere(['isread'=>0])
	        //->groupby('report_id')
	        ->orderby('id desc');

	    $query2 = MingruiComments::find() 
	        ->where([$typeOp,'report_id','gb']) 
	        ->andWhere(['<>','uid' ,'6'])
	        // ->andWhere(['isread'=>1])
	        ->groupby('report_id')
	        ->orderby('id desc');


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$query);

        $dataProviderRead = $searchModel->search(Yii::$app->request->queryParams,$query2);

        return $this->render('index4report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderRead'=> $dataProviderRead,
        ]);
    }

    

    /**
     * Displays a single MingruiComments model.
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
     * Creates a new MingruiComments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MingruiComments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id'           => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MingruiComments model.
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

    /**
     * Deletes an existing MingruiComments model.
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
     * Finds the MingruiComments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MingruiComments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MingruiComments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
