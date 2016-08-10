<?php
namespace api\controllers;

use common\models\SignupForm;
use common\models\User;
use yii;

class AuthController extends RestController
{
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
    public function actionLogin()
    {
        try{
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');
            $result = false;
            if ($username && $password) {
                $user = User::findByUsername($username);
                if(!$user) return 100301;
                $flag = $user->validatePassword($password);
                if(!$flag) return 100302;

                if ($user->access_token) {
                    $token = $user->access_token;
                } else {
                    $token              = Yii::$app->security->generateRandomString();
                    $user->access_token = $token;
                    $user->save();
                }
                $result = true;
            }

            if ($result) {
                return [
                    'result'       => 'success',
                    'access_token' => $token,
                ];
            } else {
                return 100304;
            }
        }catch(\Exception $e) {
            return 100399;
        }
    }
    public function actionSignup()
    {
        try {
            $model           = new SignupForm();
            $model->username = Yii::$app->request->post('username');
            $model->password = Yii::$app->request->post('password');

            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $token              = Yii::$app->security->generateRandomString();
                    $user->access_token = $token;
                    $user->save();

                    return ["id" => $user->id, 'access_token' => $token];
                } else {
                    return 10000;
                }
            } else {
                return $this->getFirstError($model->errors);
            }
        } catch (\Exception $e) {
            return 100299;
        }


    }

    /**
     * 第三方登录
     */
    public function ologinAction() {

    }

    /**
     * 获取登录信息
     */
    public function profileAction() {

    }

    public function myid()
    {
        return yii::$app->user->id;
    }
}
