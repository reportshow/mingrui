<?php

namespace common\models;

use Yii;


/**
 * This is the model class for table "qrcode_session".
 *
 * @property string $session
 * @property string $openid
 */
class QrcodeSession extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qrcode_session';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session'], 'required'],
            [['session'], 'string', 'max' => 255],
            [['openid'], 'string', 'max' => 128],
        ];
    }

    public function init()
    {
        $this->session = md5(time() . '-' . rand());
    }
    /**
     * 委托的URL
     * @param  [type] $urlp [description]
     * @return [type]       [description]
     */
    public function delegation($urlp)
    {
        if(!$this->save()){
            var_export($this->errors);exit;
        };
        $urlp['qr_session'] = $this->session;
        $url                = Yii::$app->urlManager->createAbsoluteUrl($urlp);
        return 'http://bshare.optimix.asia/barCode?site=weixin&url=' . urlencode($url);
        /*http://pan.baidu.com/share/qrcode?w=150&h=150&url=http://lanyes.org
    http://b.bshare.cn/barCode?site=weixin&url=http://lanyes.org
    http://s.jiathis.com/qrcode.php?url=http://lanyes.org
    http://www.kuaizhan.com/common/encode-png?large=true&data=http://lanyes.org
     */
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'session' => 'Session',
            'openid'  => 'Openid',
        ];
    }
}
