<?php
/**
 * Created by PhpStorm.
 * User: rum
 * Date: 08.10.19
 * Time: 14:11
 */

namespace app\controllers\admin;


use app\models\User;
use app\models\Work;

class UserController extends CommonController
{
    public function indexAction(){

    }

    public function loginAction(){

        if (!empty($_POST)){
            $user = new User();
            if (!$user->login(true)){
                $_SESSION['error'] = 'Логин/пароль введены не верно';
            }
            if (User::isAdmin()){
                redirect(ADMIN);
            } else {
                redirect();
            }
        }

        $this->layout = 'login';
    }

}