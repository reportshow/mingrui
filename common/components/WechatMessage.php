<?php
namespace common\components;

use yii\base\Component;

class WechatMessage extends Component
{

    public $request;
    public $master;
    public $openid;
    public function __construct($request)
    {
        $this->request = $request;
        $this->master  = $request['ToUserName'];
        $this->openid  = $request['FromUserName'];
    }
    /**
     * 回复文本消息
     * @param  [type] $content [description]
     * @return [type]          [description]
     */
    public function text($content)
    {

        return sprintf(self::TPL_TEXT, $this->openid, $this->master, time(), $content);
    }
    /**
     * 回复图文消息
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function article($data)
    {
        $count = count($data);
        if ($count < 1) {
            return;
        }

        $itemstr = '';
        foreach ($data as $item) {
            foreach ($item as $key => $val) {
                $key = '{@' . strtoupper($key) . '}';
                $itemstr .= str_replace($key, $val, self::ARTICLE_ITEM);
            }
        }
        $replace = [
            '{@OPEN_ID}'   => $this->openid,
            '{@MASTER_ID}' => $this->master,
            '{@TIME}'      => time(),
            '{@COUNT}'     => $count,
            '{@ARTICLES}'  => $itemstr];

        return str_replace(array_keys($replace), $replace, self::TPL_ARTICLE);

    }
    /**
     * 测试回复消息
     * @return [type] [description]
     */
    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if ($postStr) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
            the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj      = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername   = $postObj->ToUserName;
            $keyword      = trim($postObj->Content);
            $time         = time();
            $textTpl      = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
            if (!empty($keyword)) {
                $msgType    = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr  = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "Input something...";
            }

        } else {
            echo "no data request";
            exit;
        }
    }
    const TPL_TEXT = <<<WECHAT_TEXT
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>0</FuncFlag>
</xml>
WECHAT_TEXT;

    const TPL_ARTICLE = <<<ARTICLE
<xml>
     <ToUserName><![CDATA[{@OPEN_ID}]]></ToUserName>
     <FromUserName><![CDATA[{@MASTER_ID}]]></FromUserName>
     <CreateTime>{@TIME}</CreateTime>
     <MsgType><![CDATA[news]]></MsgType>
     <ArticleCount>{@COUNT}</ArticleCount>
     <Articles>
       {@ARTICLES}
     </Articles>
     <FuncFlag>0</FuncFlag>
</xml>
ARTICLE;

    const ARTICLE_ITEM = <<<ITEM
<item>
<Title><![CDATA[{@TITLE}]]></Title>
<Description><![CDATA[{@DESCRIPTION}]]></Description>
<PicUrl><![CDATA[{@PICURL}]]></PicUrl>
<Url><![CDATA[{@URL}]]></Url>
</item>";
ITEM;
}
