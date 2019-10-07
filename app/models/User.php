<?php
/**
 * Created by PhpStorm.
 * User: rum
 * Date: 02.10.19
 * Time: 12:22
 */

namespace app\models;


//use Illuminate\Database\Eloquent\Model;


use app\core\base\Model;
use RedBeanPHP\R;

class User extends Model
{
    public $attributes = [
        "login" => "",
        "password" => "",
        "name" => "",
        "email" => "",
//        "role" => "user"
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['email'],
            ['name']
        ],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6]
        ]
    ];

    public function checkUnique(){
        $user = R::findOne('user', 'login = ? OR email = ? LIMIT 1',
            [$this->attributes['login'], $this->attributes['email']]);
        if ($user) {
            if ($user->login == $this->attributes['login']){
                $this->errors['unique'][] = 'Этот логин занят';
            }
            if ($user->email == $this->attributes['email']){
                $this->errors['unique'][] = 'Этот email занят';
            }
            return false;
        }
        return true;
    }

    public function login(){
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if ($login && $password){
            $user = R::findOne('user', 'login = ? LIMIT 1', [$login]);
            if ($user){
                if (password_verify($password, $user->password)){
                    foreach ($user as $k => $v) {
                        if ($k !== 'password'){
                            $_SESSION['user'][$k] = $v;
                        }
                    }

                    return true;
                }
            }
        }
        return false;
    }

    public static function isLogin(){
        if(isset($_SESSION['user'])){
            return true;
        } else return false;
    }
}