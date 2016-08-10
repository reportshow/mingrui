<?php

namespace console\modules\spider\controllers;

use shark\htmlparser;
use yii\console\Controller;

class SpiderController extends Controller
{
    public function init()
    {
        date_default_timezone_set('PRC');
    }
    public function actionTest()
    {
        $html = htmlparser::init("<div class=abc>123</div>");
        echo $html->find('.abc', 0)->plaintext;
    }

    public static function fieldback($fieldname)
    {
        $fieldname = str_replace('元', 'x', $fieldname);
        return $fieldname;
    }
    public function log($errors, $lineinfo)
    {
        $buf = "\n$lineinfo\n" . var_export($errors, 1);
        file_put_contents(__DIR__ . '/error.log', $buf, FILE_APPEND);
    }
    public function HtmlfromUrl($url)
    {
        $buf = self::curl_get($url);
        return self::HtmlfromText($buf);
    }

    public function HtmlfromText($buf)
    {
        return htmlparser::init($buf);
    }

    public function curl_get($url)
    {
        return file_get_contents($url);

        $user_agent = "Mozilla/4.0";
        $proxy      = "http://192.168.21.248:3128";
        $ch         = curl_init();
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

    }
    /**
     * 东方财富把code改了名字
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function eastmoneyCode($code)
    {
        if (substr($code, 0, 1) == '6') {
            return $code . '01';
        } else {
            return $code . '02';
        }
    }
    /**
     * 检查数据是否存在
     * @param  [type] $modelname 模型名
     * @param  [type] $whereArr  条件
     * @return [type]            [description]
     */
    public static function dataExist($modelname, $whereArr)
    {
        $count = $modelname::find()->where($whereArr)->count();
        if ($count > 0) {
            //存在
            return true;
        } else {
            return false;
        }
    }
}
