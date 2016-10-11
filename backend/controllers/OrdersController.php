<?php

namespace backend\controllers;

use backend\models\MingruiOrder;
use backend\models\MingruiOrderSearch;
use backend\models\RestClient;
use backend\widgets\Nodata;
use common\components\SMS;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for MingruiOrder model.
 */
class OrdersController extends Controller
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

    public function actionTestnodata()
    {
        return Nodata::widget(['message' => '您是医生身份，无法查看自己的报告']);
    }

    /**
     * Lists all MingruiOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new MingruiOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MingruiOrder model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionWechatorder()
    {
        $order         = new MingruiOrder();
        $order->doctor = Yii::$app->user->Identity->role_tab_id;
        $order->status = 'init';
        if (!$order->save()) {
            var_export($order->errors);exit;
        }

        $mobileList = Yii::$app->params['master_vcf_mobile'];
        //$voice  = Yii::$app->params['master_vcf_voice'];
        if (!$mobileList) {
            return ('管理员电话未设置');
        }
        /*$doctorMobile = Yii::$app->user->Identity->username;
        $nickname     = Yii::$app->user->Identity->nickname; //大夫的名字*/
        $doctor = RestClient::findOne($order->doctor);
        if ($doctor) {
            $doctorMobile = $doctor->tel;
            $nickname     = $doctor->name;
            foreach ($mobileList as $key => $mobile) {
                SMS::songjian($mobile, [$nickname, $doctorMobile]);
            }
        } else {
            return "您的身份未查明。";
        }

        //SMS::landingCall($voice, $mobile);

        // $this->layout = '/layouts/main-login';
        return Nodata::widget(['title' => '送检订单已经发送', 'message' => '您将通过此功能来通知销售来取样，我们的销售将与您联系约定取样时间、地点等细节。']);

    }
    /**
     * Creates a new MingruiOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MingruiOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MingruiOrder model.
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
     * Deletes an existing MingruiOrder model.
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
     * Finds the MingruiOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MingruiOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MingruiOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
