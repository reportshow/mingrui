<?php
namespace backend\controllers;

use backend\models\WechatDoctorEvent;
use common\components\WechatMessage;
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
        //parent::init();
        $this->wechat = Yii::$app->wechat;

        $this->xml = $this->wechat->parseRequestData();
        if ($this->xml) {
            $this->reply = new WechatMessage($this->xml);
        }

    }

    public function actionTalk()
    {
        $this->wechatInit();
        /*if ($wechat->checkSignature()) {
        echo $_GET["echostr"];
        }*/
        //$this->xml['Content']
        //echo $this->reply->text(  json_encode($this->xml));

        if (1 || $this->xml['MsgType'] == "event") {
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

    public function actionMenuinit()
    {

        return Yii::$app->wechat->createMenu(Yii::$app->params['wechat_doctor']['menu']);
    }
}
