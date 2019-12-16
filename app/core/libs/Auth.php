<?php

namespace app\core\libs;


use app\models\User;
use Illuminate\Database\Eloquent\Model;

class Auth
{
//    public static $levelAccess;

    public static $errors = array();

    public static function login(){
        $username = !empty(trim($_POST['username'])) ? trim($_POST['username']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;

        if ($username && $password){

            $user = User::where('username', $username)->first();
//            dd($user);

            if(password_verify($password, $user->password)){

                if (isset($_POST['remember'])){
                    $password_cookie_token = md5($user->id.$password.time());
                    $user->password_cookie_token = $password_cookie_token;
                    $user->save();

                    setcookie('password_cookie_token', $password_cookie_token, time()+60*60*24*30, '/');

                } else{
                    $user->password_cookie_token = '';
                    $user->save();
                    setcookie('password_cookie_token', '', time()-3600*24*30*12, '/');
                }

                $_SESSION['auth'] = $user->attributesToArray();

//                self::$levelAccess = $user['role'];

                return true;
            };
            self::$errors[]['auth'] = 'Такой пользователь не найден';
            return false;
        }
        self::$errors[]['auth'] = 'Необходимо ввести логин и пароль';
        return false;
    }

    public static function getErrors(){
        $errors = '<ul>';
        foreach (self::$errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li> $item </li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }

    public static function isLogin(){
        if(isset($_SESSION['auth'])){
            return true;
        } else return false;
    }

    public static function levelAccess(){
        return $_SESSION['auth']['role'];
    }




}