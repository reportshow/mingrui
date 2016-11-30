<?php
namespace backend\controllers;

use common\models\User;
use common\models\WechatUser;
use common\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use backend\components\Functions;
use backend\widgets\Nodata;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','loginsms'],
                        'allow'   => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    { 
        return $this->render('index');
    }
    public function actionTest(){
       return $this->redirect(['/restsample/index-report' ]);
    }

    public function actionLoginsms($code, $mobile, $sms)
    {   

        if ($_SESSION['verify_code'] != $code) {

            return json_encode(['code' => 1001]);
        }
        if ($_SESSION['check_sms'] != $sms) {

            return json_encode(['code' => 1002]);
        }
        $wechat = new WechatUser();

        $mobile = $wechat->switchTestMobile($mobile);
        $user = User::find()->where(['username' => $mobile])->one();
        if (!$user) {

           /* $user =   User::newUser($mobile);
            $_SESSION['wechat_entery'] ='all';///session_start(); 
            $user = $wechat->bindMingruiUser($user, $mobile);
            */

           return json_encode(['code' => 1004]);
 
        }

        Yii::$app->user->login($user, 0);
        return json_encode(['code' => 1]);

      /* return $this->render('login', [
                'model' => $model,
            ]);*/

    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        // var_dump( Yii::$app->request->post() );exit;

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionLogin2()
    {

        return $this->render('login2', [
            'model' => $model,
        ]);

    }

    public function actionLogout()
    {
        $_SESSION['wechat_entery']=$_SESSION['openid']='';
        unset($_SESSION['openid']);
        unset($_SESSION['wechat_entery']);
        unset($_SESSION); //exit;

       // Yii::$app->user->logout();

      
        //session_unset();
        if(!Functions::ismobile()){
        	Yii::$app->user->logout();
 			return $this->goHome();
        } 
        
        echo Nodata::widget(['title' => '退出!', 'message' => '您已退出系统']);
        echo "<style>
         body {background-color:#20252B !important; 
            background-image: url(images/pic3-2.jpg) !important;
            background-size: cover !important;
            background-position: 100% !important;}
        .alert-info{margin-top: 30%;
            background-color: rgba(0, 192, 239, 0.5) !important;}
            </style>";

    }

    public function actionWeblogin()
    {
        echo "OK";
    }

}
