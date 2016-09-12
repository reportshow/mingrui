<?php
namespace backend\controllers;

use common\components\WechatMessage;
use common\models\WechatUser;
use Yii;
use yii\web\Controller;
use backend\models\WechatEvent;
use backend\models\WechatSickEvent;
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
        $this->wechatInit();
        /*if ($wechat->checkSignature()) {
        echo $_GET["echostr"];
        }*/
        //$this->xml['Content']
        //echo $this->reply->text(  json_encode($this->xml));

        if (1 || $this->xml['MsgType'] == "event") {
           $ev = new WechatSickEvent($this->xml);
           echo $ev->response();
        }
        exit;
        //send message
        //$rlt =  $wechat->sendText($xml['FromUserName'], 'xxxx');
        //if($rlt){}
    }

    public function actionMyReport()
    {
        WechatUser::show(['rest-report/view', 'id' => 1]);
    }
    public function actionMyUpload()
    {
        WechatUser::show(['mingrui-mypic/create']);
    }
    public function actionMyPic()
    {
        WechatUser::show(['mingrui-mypic/index']);
    }

    public function actionNotesIndex()
    {
        WechatUser::show(['mingrui-note/index']);
    }
    public function actionNotesNew()
    {
        WechatUser::show(['mingrui-note/create']);
    }
    public function actionMenuinit()
    {

        return Yii::$app->wechat->createMenu(Yii::$app->params['wechat_sick']['menu']);
    }
}
