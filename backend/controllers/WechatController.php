<?php
namespace backend\controllers;

use backend\models\WechatSickEvent;
use common\components\WechatMessage;
use common\models\QrcodeSession;
use common\models\User;
use common\models\WechatUser;
use Yii;
use yii\web\Controller;

use mdm\admin\models\Assignment;
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

    public function actionTest1()
    {
        $user =   User::findOne(6);

     /*   $model = new Assignment(10);
        $success = $model->assign(['guest']); 
*/
         $auth = Yii::$app->authManager; 
         $role = (object) null;
         $role->name = 'guest';
            $auth->assign(  $role, 11);;


    }

    public function actionMyReport()
    {
        WechatUser::show(['rest-report/myreport' ]);
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
        WechatUser::show(['wechat/weblogin-done']);
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
