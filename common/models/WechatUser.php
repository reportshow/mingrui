<?php
namespace common\models;

use Yii;

class WechatUser
{
    /**
     * 认证的回调
     * @param  [type] $ctrl [description]
     * @return [type]       [description]
     */
    public static function actionLogin($ctrl)
    {
        $rlt = self::userInfo();
        if ($rlt == 'ok') {
            echo "已经登记过";
        } else if ($rlt && !empty($rlt['openid'])) {
            return $ctrl->render('askmobile');

        } else if ($rlt == 'askmobile') {

            return $ctrl->render('askmobile');
        } else {

        }
    }
    public static function userInfo()
    {
        //获得openid  accessToken
        $oauth = Yii::$app->wechat->getOauth2AccessToken($_GET['code']);

        $user = User::find()->where(['wx_openid' => $oauth['openid']])->one();
        if (!$user) {
            //获得微信个人资料
            $wechatinfo = Yii::$app->wechat->getSnsMemberInfo($oauth['openid'], $oauth['access_token']);
            //保存资料
            $rlt = self::newUser4wechat($wechatinfo);
            if ($rlt) {
                $_SESSION['openid'] = $oauth['openid'];
                return $wechatinfo;
            } else {

            }
        } else {
            $_SESSION['openid'] = $oauth['openid'];
            if ($user->status == 0) { //登记过，但是么没绑定手机
                return 'askmobile';
            }
            return 'ok';
        }

    }
    /**
     * 检查用户身份
     * @return [type] [description]
     */
    public static function oauth()
    {
        if ($_SESSION['openid']) {
            echo "cookie里有信息";
            return true;
        }

        //去微信认证
        $redirectUrl = Yii::$app->urlManager->createAbsoluteUrl(['wechat/login']);
        $toUrl       = Yii::$app->wechat->getOauth2AuthorizeUrl($redirectUrl, 'LOGIN', 'snsapi_userinfo');
        header("Location: $toUrl");
        exit;

    }

    public static function newUser4wechat($info)
    {
        $user           = new User();
        $user->username = 'unset-' . $info['openid'];
        $user->setPassword(rand());
        $user->generateAuthKey();
        $user->access_token = hash('sha256', $info['openid']);
        $user->status       = 0;

        $user->email     = 'x';
        $user->wx_openid = $info['openid'];
        $user->avatar    = $info['headimgurl'];
        $user->nickname  = $info['nickname'];

        $user->created_at = $user->updated_at = time();
        if (!$user->save()) {
            var_export($user->errors);
        }
        return true;
    }
}
 