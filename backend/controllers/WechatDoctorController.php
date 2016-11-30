<?php
namespace backend\controllers;

use backend\models\WechatDoctorEvent;
use backend\widgets\Nodata;
use common\components\WechatMessage;
use common\models\QrcodeSession;
use common\models\User;
use common\models\WechatUser;
use Yii;
use yii\web\Controller;

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
        $_GET['role'] = 'doctor';
        WechatUser::switchWechat();
    }
    public function action2Test()
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
        // exit($_GET["echostr"] ) ;
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
    public function show($url)
    {
        WechatUser::show([$url, 'role' => 'doctor'], 'doctor');
    }

    public function actionReport()
    {
        self::show('rest-report/index');
    }
    public function actionSearch()
    {
        self::show('restsample/search');
    }
    public function actionSicklist()
    {
        self::show('restsample/index');
    }

    public function actionDoorder()
    {
        self::show('orders/wechatorder');

    }

    public function actionHomepage()
    {
        self::show('');

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
        self::show('wechat-doctor/weblogin-done');
    }
    public function actionWebloginDone()
    {
        $qs = QrcodeSession::findOne($_SESSION['qr_session']);
        if ($qs) {
            $qs->openid = $_SESSION['openid'];
            $qs->save();
        }

        echo Nodata::widget(['title' => '登录成功!', 'message' => '您已经成功登录到明睿系统']);
        echo "<style>
         body {background-color:#20252B !important; 
            background-image: url(images/pic3-2.jpg) !important;
            background-size: cover !important;
            background-position: 100% !important;}
        .alert-info{margin-top: 30%;
            background-color: rgba(0, 192, 239, 0.5) !important;}
            </style>";
    }

    /**
     * 电脑 从这里得到结果
     * @param  [type] $qr_session [description]
     * @return [type]             [description]
     */
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
