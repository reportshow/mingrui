<?php
namespace backend\controllers;

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
    /**
     * 绑定 手机号
     * @return [type] [description]
     */
    public function actionBindMobile()
    {
        $model = new WechatUser();

        if ($model->load(Yii::$app->request->post()) && $user = $model->bindMobile()) {
            //权限获取完毕

            self::entery($user);

        } else {
            var_export($model->errors);
            return self::askMobile();
        }

    }
    /**
     * [entery description]
     * @return [type] [description]
     */
    public static function entery($user)
    {
        Yii::$app->user->login($user, 0);
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
        if ($user) {
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
