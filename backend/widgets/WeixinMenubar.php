<?php
namespace backend\widgets;

use backend\components\Functions;
use Yii;
use yii\base\Widget;

class WeixinMenubar extends Widget
{

    public function run()
    {
        if (Functions::ismobile()) {
            $menus = Yii::$app->params['wechat_doctor']['menu'];

            return $this->render('WeixinMenubar', ['menus' => $menus]);
        } else {
            return '';
        }

    }
}
}
