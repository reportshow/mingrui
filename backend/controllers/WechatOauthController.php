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
    }

    public function actionTest()
    {
        return self::askMobile($this);
        // return $this->render('askmobile');
    }
    /**
     * 绑定 手机号
     * @return [type] [description]
     */
    public function actionBindMobile()
    {
        $model = new WechatUser();

        if ($model->load(Yii::$app->request->post()) && $model->bindMobile()) {
            exit('okkkkkk');
        } else {
            var_export($model->errors);
            return self::askMobile($this);
        }

    }

    /**
     * wechat认证的回调
     * @param  [type] $ctrl [description]
     * @return [type]       [description]
     */
    public function actionLogin()
    {

        $rlt = self::userInfo();
        if ($rlt && !empty($rlt['wx_openid'])) {
            //数据库记录
            echo "之前登记过";
        } else if ($rlt && !empty($rlt['openid'])) {
            //wechat返回
            self::askMobile();

        } else if ($rlt == 'askmobile') {
            self::askMobile();
        } else {

        }

    }

    public static function askMobile($ctrl)
    {
        $model = new WechatUser();

        $bindMobileUrl = Yii::$app->urlManager->createUrl(['/wechat-oauth/bind-mobile']);
        $content       = $ctrl->render('/wechat/bind-mobile', ['model' => $model, 'bindMobileUrl' => $bindMobileUrl]);

        return $ctrl->render(
            '/layouts/main-login',
            ['content' => $content]
        );

    }

}
