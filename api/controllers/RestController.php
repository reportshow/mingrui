<?php
namespace api\controllers;

use yii\rest\Controller;
use yii\filters\auth\QueryParamAuth;

class RestController extends Controller
{
    protected $myParams;
    public function behaviors()
    {
        $behaviors                                 = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = ['application/json' => 'json'];
        $behaviors['authenticator']                = [
            'class'      => QueryParamAuth::className(),
            'tokenParam' => 'access_token',
        ];
        return $behaviors;
    }

    public function actionRun() { //为了统一加try{}catch(){}块
        //获取参数，参数统一解密
        if(!$this->checkSign()) return 0;//签名错误
        $this->getParams();
        $method = $this->myParams['method'];
        //当方法中有种横线的时候，反解析中横线
        if(strpos($method,'-')!==false) {
            $tempArray = explode('-',$method);
            $method = '';
            foreach($tempArray as $val) {
                $method .= ucfirst($val);
            }
        }
        $method = 'action' . ucfirst($method);

        $result = $this->$method();
        return $result;
        //返回统一加密
    }

    public function getSign() {
        $params = $this->myParams;
        unset($params['method']);
        unset($params['access_token']);
        unset($params['sign']);//前端传过来的签名值
        $params['key'] = '@%*asdf@$124'; //密钥
        ksort($params);
        $str = '';
        foreach($params as $key => $val) {
            $str .= "{$key}={$val}&";
        }

        return md5(trim($str,'&'));
    }

    protected function checkSign() {
        return $this->myParams['sign'] === $this->sign;
    }

    public function getParams() {
        $params = \Yii::$app->request->get();//获取get参数
        $postParams = \Yii::$app->request->post();//获取post参数
        $this->myParams = array_merge($params,$postParams);
    }

    public function afterAction(
        $action, $result)
    {
        $result = parent::afterAction($action, $result);
        if(is_numeric($result)) {
            $errmsg = $this->getMessage($result);
            return [
                'code' => '' . $result,
                'errmsg' => $errmsg,
                'data' => []
            ];
        }

        return ['code' => '1', 'errmsg' => '', 'data' => $result];
    }

    public function getMessage($result) {
        return \Yii::t('app', $result);
    }

    public function getFirstError($errors)
    {
        foreach ($errors as $error) {
            if (isset($error[0]) && is_numeric($error[0])) {
                return $error[0];
            }
        }
    }

}
