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
        //var_dump($_SESSION);
        Yii::$app->user->logout();

        unset($_SESSION['openid']);
        unset($_SESSION['wechat_entery']);
        unset($_SESSION); //exit;
        return $this->goHome();
    }

    public function actionWeblogin()
    {
        echo "OK";
    }

}
