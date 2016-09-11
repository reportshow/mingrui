<?php
namespace backend\controllers;

use common\components\WechatMessage;
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
        parent::init();
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

        echo $this->reply->text($this->xml['Content'] . '=222');

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
        WechatUser::show(['mingrui-mypic/index']);
    }
    public function actionMyPic()
    {

    }

    public function actionNotesIndex()
    {

    }
    public function actionNotesNew()
    {

    }

}
