<?php

namespace common\models;
use common\models\Myreports;
use Yii;

/**
 * This is the model class for table "realtime_report".
 *
 * @property string $id
 * @property string $code
 * @property string $title
 * @property string $createtime
 * @property string $url
 * @property string $type
 */

class RealtimeReport extends \yii\db\ActiveRecord
{
    public $time;
    public $share_url;
    public $pdf_url;
    public $detail;
    public $isStore;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'realtime_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'title', 'createtime'], 'required'],
            [['code'], 'integer'],
            [['createtime'], 'safe'],
            [['title', 'url'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '股票代码',
            'title' => '标题',
            'createtime' => '公告时间',
            'url' => '公告地址',
            'type' => '类型',
            'time' => '时间',
            'isMyCode' => '是否收藏'
        ];
    }

    /**
     * 为了扩展属性在json里
     * @return array
     */
    public function attributes() {
        $attr = parent::attributes();
        $attr[] = 'time';
        $attr[] = 'share_url';
        $attr[] = 'pdf_url';
        $attr[] = 'detail';
        $attr[] = 'isStore';
        return $attr;
    }

    /**
     *
     */
    public static function getReportListByIds(array $ids = []) {
        $data = self::findAll($ids);
        return $data;
    }

    public function afterFind() {
        $this->type .= '';
        $this->url .= '';
        $this->time = strtotime($this->createtime) . '';
        $this->share_url .= '';
        $this->pdf_url .= '';
        $this->detail .= '' . $this->title;
        $this->code .= '';
        $this->isStore .=  Myreports::isStore($this->id);
        /**
         * 必须保证类的属性里和_attributes里的值一样。yii就是这里比较麻烦
         */
        $this->setAttribute('share_url','');
        $this->setAttribute('pdf_url','');
        $this->setAttribute('detail',$this->title);
        $this->setAttribute('isStore',Myreports::isStore($this->id));
    }

    //查询是否被收藏

}
