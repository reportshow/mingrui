<?php

namespace backend\controllers;

use backend\models\MingruiOrder;
use Yii;
use yii\web\Controller;
use common\models\User;
/**
 * OrdersController implements the CRUD actions for MingruiOrder model.
 */
class ProfileController extends Controller
{
    /**
     *
     * @return [type] [description]
     */
    public function actionShow()
    {
        return $this->render('password', []);

    }

    public function actionSetpassword()
    {
        $oldP = Yii::$app->request->post('oldpassword');
        $new  = Yii::$app->request->post('newpassword');
        $new2 = Yii::$app->request->post('newpassword2');
        if ($new != $new2) {
            return json_encode(['code' => 102, 'msg' => '两次输入的新密码不一致']);
        }

        if(0){
            return json_encode(['code' => 103, 'msg' => '旧密码错误']);
        }
        $user = User::findOne(Yii::$app->user->id);
        $user->setPassword($new);
        $user->save();
        return json_encode(['code' => 1, 'msg' => 'OK，修改密码完成']);

    }
}
