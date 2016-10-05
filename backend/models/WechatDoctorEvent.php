<?php
namespace backend\models;

use common\components\SMS;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class WechatDoctorEvent extends WechatEvent
{

    public function work_flow()
    {
        $article = [
            ['title'      => '检测流程',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/1.png',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/'],
            ['title'      => '检测流程',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/2.png',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/'],
            ['title'      => '服务承诺',
                'description' => '精准服务',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/3.png',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/'],
            ['title'      => '联系我们',
                'description' => '联系方式，欢迎反馈',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/user1-128x128.jpg',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/'],
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

        //SMS::songjian($mobile, ['张', $mobile]);
       // SMS::landingCall($voice, $mobile);
        //
        $url = Yii::$app->urlManager->createAbsoluteUrl(['wechat-doctor/doorder']);
        return $this->reply->text('你即将发起一个送检需求，请'.
         "\n请点击<a href=\"$url\">确定</a>"  );
        
    }
}
