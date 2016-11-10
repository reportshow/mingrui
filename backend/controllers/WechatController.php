<?php
namespace backend\controllers;

use backend\models\WechatSickEvent;
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
class WechatController extends Controller
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
    }

    public function wechatInit()
    {
        //parent::init();
        $this->wechat = Yii::$app->wechat;

        $this->xml = $this->wechat->parseRequestData();
        if ($this->xml) {
            $this->reply = new WechatMessage($this->xml);
        }

    }

    public function actionTalk()
    {
        // exit($_GET["echostr"] ) ;

        $this->wechatInit();
        /*if ($wechat->checkSignature()) {
        echo $_GET["echostr"];
        }*/
        //$this->xml['Content']
        // echo $this->reply->text(  json_encode($this->xml));

        if ($this->xml['MsgType'] == "event") {
            $ev = new WechatSickEvent($this->xml);
            echo $ev->response();
        }
        exit;
        //send message
        //$rlt =  $wechat->sendText($xml['FromUserName'], 'xxxx');
        //if($rlt){}
    }

    public function actionTest1()
    {
        \common\components\SMS::sendSMS('13910136035', [123, 789]);

    }
    public function show($url)
    {
        WechatUser::show([$url ], 'guest');
    }

    public function actionMyReport()
    {
        self::show('rest-report/myreport');
    }

    public function actionMyUpload()
    {
        self::show('mingrui-mypic/create');
    }
    public function actionMyPic()
    {
       // self::show('mingrui-mypic/index');
       // 
       self::show('mingrui-attachment/myattachment'); 
    }

    public function actionNotesIndex()
    {
        self::show('mingrui-note/index');
    }
    public function actionNotesNew()
    {
        self::show('mingrui-note/create');
    }
    public function actionMenuinit()
    {
        var_export(Yii::$app->params['wechat_sick']['menu']);

        return Yii::$app->wechat->createMenu(Yii::$app->params['wechat_sick']['menu']);
    }

    //
    //=========================================================
    //
    /**
     * 通过wechat，网页登陆
     * @return [type] [description]
     */
    public function actionWeblogin()
    {
        $_SESSION['qr_session'] = $_GET['qr_session'];
        self::show( 'wechat/weblogin-done' );
    }
    public function actionWebloginDone()
    {
        $qs = QrcodeSession::findOne($_SESSION['qr_session']);
        if ($qs) {
            $qs->openid = $_SESSION['openid'];
            $qs->save();
        }

        echo Nodata::widget(['title' => '登录成功!', 'message' => '您已经成功登录到明睿系统']);
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
