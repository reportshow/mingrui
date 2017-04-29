<?php

namespace apps\controllers;

use Yii;
use apps\models\GenelistOrder;
use apps\models\GenelistOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\components\SMS;
/**
 * GenelistOrderController implements the CRUD actions for GenelistOrder model.
 */
class GenelistOrderController extends Controller
{
    public $enableCsrfValidation = false;

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
     * Displays a single GenelistOrder model.
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
     * Creates a new GenelistOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GenelistOrder();

        if ($model->load(Yii::$app->request->post()) ) {
        	$model->createtime= time();
        	$model->state ='create';
        	if( $model->save()){

        	  $data = [$model->name .'/'. $model->city , $model->tel];
        	  //SMS::songjian(13910136035, $data);
        	  SMS::songjian(18810546254, $data);
        	  return $this->redirect(['view', 'id'           => $model->id]);
        	}
           
        }    
        return $this->render('create', [
                'model' => $model,
        ]);
        
    }
 
   
    /**
     * Finds the GenelistOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GenelistOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GenelistOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
