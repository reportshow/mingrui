<?php
namespace backend\controllers;

use backend\models\MingruiNotes;
use common\components\SMS;
use common\models\WechatUser;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class WechatOauthController extends Controller
{
    public $layout               = false;
    public $enableCsrfValidation = false;

    public $xml;
    public $reply;
    public $wechat;

    public function init()
    {
        session_start();
        if (!empty($_GET['role']) && $_GET['role'] == 'doctor') {
            WechatUser::switchWechat();
        }

    }

    public function actionTest()
    {
        return self::askMobile();
        // return $this->render('askmobile');
    }

    public function actionGetsms($mobile)
    {
        /*if ($_SESSION['check_sms_time'] >= time()-60) {
            return json_encode(['code' => 1]);
        }*/

        
        //$mobile                = Yii::$app->request->post('mobile');
        $_SESSION['check_sms']      = rand(1000, 9999);
        $_SESSION['check_sms_time'] = time();
        //SMS::voiceVerify($_SESSION['check_sms'], $mobile);
        SMS::SMS($mobile, [$_SESSION['check_sms'], 20]);
        return json_encode(['code' => 1]);
    }
    /**
     * 绑定 手机号
     * @return [type] [description]
     */
    public function actionBindMobile()
    {
        if (empty($_SESSION['check_sms'])) {
            exit('请获取短信验证码');
        }
        if ($_SESSION['check_sms'] != Yii::$app->request->post('smscode')) {
            echo "<h1>短信验证码错误</h1>";
            //return;
        }

        $model = new WechatUser();

        if ($model->load(Yii::$app->request->post()) && $user = $model->bindMobile()) {
            //权限获取完毕
            self::init1stLogin();
            self::entery($user);

        } else {
            //var_export($model->errors);
            return self::askMobile();
        }

    }

    public function init1stLogin()
    {

        if (Yii::$app->authManager->checkAccess(Yii::$app->user->id, 'guest')) {

            $nt          = new MingruiNotes();
            $nt->type    = 'text';
            $nt->title   = '欢迎';
            $nt->content = "今天我第一次使用明睿云病例";
            $nt->save();

        }

    }
    /**
     * [entery description]
     * @return [type] [description]
     */
    public static function entery($user)
    {
        Yii::$app->user->login($user, 0);
        if (Yii::$app->user->isGuest) {
            exit('Login finally failed!!');
        }

        header('Location: ' . $_SESSION['entery_url']);
        exit();
    }

    /**
     * wechat认证的回调
     * @param  [type] $ctrl [description]
     * @return [type]       [description]
     */
    public function actionLogin()
    {
        $user = WechatUser::wechatUserInfo();
        if (!is_string($user)) {
            if ($user->status == 0) {
                return self::askMobile();

            } else {
                //权限获取完毕
                self::entery($user);
            }
        } else {
            exit('WechatUser::userInfo fail');
        }

    }

    public function askMobile()
    {
        $model = new WechatUser();

        $bindMobileUrl = WechatUser::createUrl(['/wechat-oauth/bind-mobile']);
        $content       = $this->render('/wechat/bind-mobile', ['model' => $model, 'bindMobileUrl' => $bindMobileUrl]);

        return $this->render(
            '/layouts/main-login',
            ['content' => $content]
        );

    }

}
