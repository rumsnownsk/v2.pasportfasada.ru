<?php

namespace app\controllers;

use app\core\base\Controller;
use app\core\base\View;
use app\models\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class UserController extends Controller
{
    public function signupAction(){
        if(!empty($_POST)){
            $user = new User();
            $user->load($_POST);
            if (!$user->validate($_POST) || !$user->checkUnique()){
                $user->getErrors();
                $_SESSION['form_data'] = $_POST;
                redirect();
            }

            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);

            if ($user->save('user')){
                $_SESSION['success'] = 'Вы зарегались';
                redirect('/');
            } else {
                $_SESSION['error'] = 'Провал. Чтото пошло не так';
            };
            redirect();

        }
        $this->setMeta('Регистрация');
    }

    public function loginAction(){
        if(!empty($_POST)){
            $user = new User();
            if($user->login()){
                $_SESSION['success'] = 'Вы успешно авторизованы';
                redirect('/');
            } else {
                $_SESSION['error'] = 'Логин/Пароль введены неверно';
            };
            redirect();
        }

        $this->setMeta('Авторизация');
    }

    public function logoutAction(){
//        $this->view = false;
        if (User::isLogin()){
            unset($_SESSION['user']);
        }
        redirect('/');
    }


    public function indexAction(){

        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(ROOT.'/temp/logAdmin.log', Logger::WARNING));

        // add records to the log
        $log->warning('Foo');
        $log->error('Bar');

        $this->layout = 'default';

        $this->setMeta('Админка', 'Описание админки', 'Keywords for admin');
        $users = 'Директор';
        $this->set(compact('users'));
    }

    public function testAction(){
        $this->layout = 'admin';

        echo __METHOD__;
    }
}