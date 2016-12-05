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
            ['title'      => '进入首页',
                'description' => '检测的每个步骤须知',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-1.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php'],
            ['title'      => '查看报告',
                'description' => '查看报告',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-2.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/?r=wechat/my-report'],
            ['title'      => '上传图片',
                'description' => '上传图片',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-3.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/?r=wechat/my-upload'],
            ['title'      => '联系方式',
                'description' => '联系方式，欢迎反馈',
                'picurl'      => 'http://www.mono-mr.com/backend/web/images/qa-4.jpg',
                'url'         => 'http://www.mono-mr.com/backend/web/index.php?r=mingrui-qa%2Fviewcontact&id=1'],
        ];
        return $this->reply->article($article);
    }

    public function scan($scene_id)
    {

    }
}
