<?php
/**
 * Created by PhpStorm.
 * User: rum
 * Date: 19.11.19
 * Time: 20:59
 */

namespace app\controllers;

use app\controllers\admin\AdminController;
use app\core\base\Controller;
use app\core\libs\Auth;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loginAction()
    {
        $this->autoLogin();


        if (!empty($_POST)) {
            if (Auth::login()) {
//                dd($_SESSION['auth']);
                redirect('/admin');
            } else {
                Auth::getErrors();
                redirect();
            }
        }

        $this->render('auth/login');

    }

    protected function autoLogin(){
        if (isset($_COOKIE['password_cookie_token']) && !empty($_COOKIE['password_cookie_token'])) {
            $user = User::where('password_cookie_token', $_COOKIE['password_cookie_token'])->first();
            if ($user) {
//                dd($user->attributesToArray());
                $_SESSION['auth'] = $user->attributesToArray();
                redirect('/admin');
            }
        }
    }

    public function logoutAction()
    {
        if (Auth::isLogin()) {
            $auth = $_SESSION['auth'];
            $user = User::find($auth['id']);
            $user->password_cookie_token = '';
            $user->save();

            setcookie('password_cookie_token', '', time()-3600*24*30*12, '/');
            session_unset();
        }

        redirect('/');
    }


//    public static function isAuth()
//    {
//        if (isset($_SESSION['auth'])) {
//            return true;
//        } else return false;
//    }
//
//    public static function isAdmin()
//    {
//        return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
//    }

}