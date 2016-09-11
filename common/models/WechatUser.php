<?php
namespace common\models;

use common\models\User;
use Yii;
use yii\base\Model;

class WechatUser extends Model
{
    public $mobile;
    public $smscode;
    public $openid;

    public function rules()
    {
        return [
            [['mobile', 'smscode', 'openid'], 'safe'],
        ];
    }
    public function bindMobile()
    {
        // 1.检查sms
        // TODO
        //2. 保存手机号
        if (!$this->openid) {
            $this->openid = $_SESSION['openid'];
        }
        if (!$this->openid) {
            return;
        }
        $user = User::find()->where(['wx_openid' => $this->openid])->one();
        if ($user) {
            $user->username = $this->mobile;
            $user->status   = 10;

            $user->updated_at = time();
            if (!$user->save()) {
                var_export($user->errors);
                exit;
            }
            return true;
        } else {
            exit('没有该用户openid=' . $this->openid);
        }

    }
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }
    public function getMobile()
    {
        return $this->mobile;
    }

    public static function actionLogin($ctrl)
    {

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
                return 'get wechat info fail';
            }
        } else {
            $_SESSION['openid'] = $oauth['openid'];
            if ($user->status == 0) {
                //登记过，但是么没绑定手机
                return 'askmobile';
            }
            return $user;
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
        $redirectUrl = Yii::$app->urlManager->createAbsoluteUrl(['wechat-oauth/login']);
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
