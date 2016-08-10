<?php
namespace api\components;

use Yii;
use yii\helpers\VarDumper;
use yii\web\ResponseFormatterInterface;
class JsonFormatter implements ResponseFormatterInterface
{
    public function format($response)
    {
        $response->getHeaders()->set('Content-Type', 'application/Json;');
        if(is_numeric($response->data)){
            $response->content = $this->encode(NULL, intval($response->data), \Yii::t('apicode', $response->data));
        }else{
            if(isset($response->data['code'])){
                if(isset($response->data['status'])){
                    $response->content = $this->encode(NULL,$response->data['status'], \Yii::t('apicode', $response->data['status']));
                }else{
                    $response->content = json_encode($response->data);
                }
            }else{
                $response->content = $this->encode($response->data);
            }
        }
    }

    /* ----------------------------------------------------------------------------*/
    /**
     * @Synopsis  返回Json封装数据
     *
     * @Param $res       数据
     * @Param $code      状态码
     * @Param $errmsg    错误信息
     *
     * @Returns   JSON封装后的数据
     */
    /* ----------------------------------------------------------------------------*/
    private function encode( $res, $code = 1, $errmsg = ''){
        $return = [ 
            'code'  => $code,
            'errmsg'=> $errmsg,
            'data'  => [],
        ];
        if(!empty($res)){
            $return =  array_merge($return, ['data'=>$res]);
        }
        return json_encode($return);
    }
}
