<?php
namespace backend\models;

use common\components\SMS;
use Yii;
use yii\web\Controller;
use common\models\User;
/**
 * Site controller
 */
class WechatDoctorEvent extends WechatEvent
{

    public function work_flow()
    {
       /* $article = [
            ['title'      => '检测流程',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/1.png',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=mingrui-qa'],
            ['title'      => '检测流程',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/2.png',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=mingrui-qa'],
            ['title'      => '服务承诺',
                'description' => '精准服务',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/3.png',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=mingrui-qa'],
            ['title'      => '联系我们',
                'description' => '联系方式，欢迎反馈',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/user1-128x128.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=mingrui-qa'],
        ];
        */
       
       $article = [
            ['title'      => '进入首页',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-1.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php'],
            ['title'      => '报告管理',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-2.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=restsample%2Findex-report&RestSampleSearch%5Bname%5D='],
            ['title'      => '我的病人',
                'description' => '精准服务',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-3.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=restsample%2Findex&RestSampleSearch%5Bname%5D='],
            ['title'      => '联系方式',
                'description' => '联系方式，欢迎反馈',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-4.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=mingrui-qa%2Fviewcontact&id=1'],
        ];
        return $this->reply->article($article);
    }

    public function sample_order()
    {
        $mobile = Yii::$app->params['master_vcf_mobile'];
        $voice  = Yii::$app->params['master_vcf_voice'];
        if (!$mobile) {
            return $this->reply->text('管理员电话未设置');
        }
         
        $openid = $this->reply->openid;
        
        return $this->reply->text(
            "您送检样本申请已通过此功能来通知客服部，稍后我们会主动与您联系约定取样时间、地点等细节。"
            );
        

        $doctor = User::find()->where(['wx_openid' => $openid])->one();
        if ($doctor) {
             
            if ($doctor->role_text != 'doctor') {
                return $this->reply->text('您没有大夫权限');
            }
            $doctorMobile = $doctor->username;
            $nickname     = $doctor->nickname; //大夫的名字
            SMS::songjian($mobile, [$nickname, $doctorMobile]);

           return $this->reply->text(
            "您送检样本申请已通过此功能来通知客服部，稍后我们会主动与您联系约定取样时间、地点等细节。"
            );
        } else {
            $loginUrl = Yii::$app->urlManager->createAbsoluteUrl(['wechat/weblogin', 'qr_session' => 'login_itself']);
            return $this->reply->text("\n请点击<a href=\"$loginUrl\">请点击这里</a> 进行身份确认");
            // SMS::songjian($mobile, ['XX医生', $mobile]);
        }

        // SMS::landingCall($voice, $mobile);
        //
        /*   $url = Yii::$app->urlManager->createAbsoluteUrl(['wechat-doctor/doorder']);
    return $this->reply->text('你即将发起一个送检需求，请'.
    "\n请点击<a href=\"$url\">确定</a>"  );*/

    }
}
