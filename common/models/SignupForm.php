<?php
namespace common\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;

    public function rules()
    { 
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => '用户名不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\User' ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required', 'message' => '密码不能为空'],
            ['password', 'string', 'min' => 6],
        ]; 
    }

//注意这个方法里user表的字段
    public function signup()
    {
        if ($this->validate()) {
            $user           = new User();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->created_at = time();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

}
