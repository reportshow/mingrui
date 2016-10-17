<?php
namespace backend\models;

use yii\web\Controller;

/**
 * Site controller
 */
class WechatSickEvent extends WechatEvent
{

    public function work_flow()
    {
        $article = [
            ['title'      => '检测流程',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/1.png',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/index.php?r=mingrui-qa'],
            ['title'      => '检测流程',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/2.png',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/index.php?r=mingrui-qa'],
            ['title'      => '服务承诺',
                'description' => '精准服务',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/3.png',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/index.php?r=mingrui-qa'],
            ['title'      => '联系我们',
                'description' => '联系方式，欢迎反馈',
                'picurl'      => 'http://ding.scicompound.com/mingrui/report/backend/web/images/user1-128x128.jpg',
                'url'         => 'http://ding.scicompound.com/mingrui/report/backend/web/index.php?r=mingrui-qa'],
        ];
        return $this->reply->article($article);
    }

    public function scan($scene_id)
    {

    }
}
