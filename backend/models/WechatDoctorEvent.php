<?php
namespace backend\models;

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
         return $this->reply->text('你的订单已经发往销售部门，我们很快会与你联系');
    }
}
