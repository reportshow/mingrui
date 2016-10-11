<?php
namespace backend\controllers;

use backend\models\WechatDoctorEvent;
use common\components\WechatMessage;
use common\models\QrcodeSession;
use common\models\User;
use common\models\WechatUser;
use Yii;
use yii\web\Controller;
use backend\widgets\Nodata;
use backend\models\MingruiOrder;

/**
 * Site controller
 */
class WechatDoctorController extends Controller
{
    public $layout               = false;
    public $enableCsrfValidation = false;

    public $xml;
    public $reply;
    public $wechat;
    /*public function beforeAction(){

    }*/

    public function init()
    {
        session_start();
        $_GET['role'] = 'doctor';
        WechatUser::switchWechat();
    }
    public function actionTest()
    {
        echo Yii::$app->urlManager->createAbsoluteUrl(['xx/yyy', 'role' => $_GET['role']]);
    }
    public function wechatInit()
    {
        // file_put_contents('upload/x.txt',  $GLOBALS["HTTP_RAW_POST_DATA"]);

        $this->wechat = WechatUser::getWechat(true);

        $this->xml = $this->wechat->parseRequestData();
        //file_put_contents('upload/wechat.do.txt', var_export($this->xml,1));

        if ($this->xml) {
            $this->reply = new WechatMessage($this->xml);
        }

    }

    public function actionTalk()
    {
        //exit($_GET["echostr"] ) ;
        //
        //    file_put_contents('filename', data)
        $this->wechatInit();
        /*if ($wechat->checkSignature()) {
        echo $_GET["echostr"];
        }*/
        //$this->xml['Content']

        //exit($this->reply->text('000'));

        if ($this->xml['MsgType'] == "event") {

            $ev = new WechatDoctorEvent($this->xml);
            echo $ev->response();
        }
        exit;
        //send message
        //$rlt =  $wechat->sendText($xml['FromUserName'], 'xxxx');
        //if($rlt){}
    }

    public function actionReport()
    {
        WechatUser::show(['rest-report/index', 'role' => 'doctor']);
    }
    public function actionSearch()
    {
        WechatUser::show(['rest-report/search', 'role' => 'doctor']);
    }
    public function actionSicklist()
    {
        WechatUser::show(['restsample/index', 'role' => 'doctor']);
    }

    public function actionDoorder()
    {
       WechatUser::show(['orders/wechatorder', 'role' => 'doctor']);

    }

    public function actionMenuinit()
    {
        $wechat = WechatUser::getWechat(true);
        var_export(Yii::$app->params['wechat_doctor']['menu']);
        return $wechat->createMenu(Yii::$app->params['wechat_doctor']['menu']);
    }

    //
    //=======================================================================================================
    //
    /**
     * 通过wechat，网页登陆
     * @return [type] [description]
     */
    public function actionWeblogin()
    {
        $_SESSION['qr_session'] = $_GET['qr_session'];
        WechatUser::show(['wechat-doctor/weblogin-done']);
    }
    public function actionWebloginDone()
    {
        $qs = QrcodeSession::findOne($_SESSION['qr_session']);
        if ($qs) {
            $qs->openid = $_SESSION['openid'];
            $qs->save();
        }

        $content = (' <div class="alert alert-info alert-dismissible" style="margin-top:100px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> 登录成功!</h4>
                您已经成功登录到明睿系统
              </div>');

        echo $this->render(
            '/layouts/main-login',
            ['content' => $content]
        );
    }

    public function actionWebloginCheck($qr_session)
    {
        $qs = QrcodeSession::findOne($_GET['qr_session']);
        if ($qs && $qs->openid) {
            $user = User::find()->where(['wx_openid' => $qs->openid])->one();
            if ($user) {
                Yii::$app->user->login($user, 0);
                return json_encode(['code' => 1]);
            }

        }
    }
}
