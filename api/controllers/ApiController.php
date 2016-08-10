<?php
namespace api\controllers;

use common\models\AppInfo;
use yii;

class ApiController extends RestController
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        /*$behaviors['authenticator']                = [
        'class'      => QueryParamAuth::className(),
        'tokenParam' => 'access_token',
        ];*/
        unset($behaviors['authenticator']);
        return $behaviors;
    }

    public function actionCheck() {
        $version = Yii::$app->request->get('appver');
        $data = AppInfo::find()->orderBy(['id' => 'desc'])->one();
        return $data;
    }

    /**
     * 获取某个接口的新增数据
     */
    public function actionConst() {
        $apiname = Yii::$app->request->get('apiname');
        //需要使用runAction来实现

    }
}
