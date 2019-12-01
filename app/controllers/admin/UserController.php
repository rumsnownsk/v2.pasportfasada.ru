<?php

namespace app\controllers\admin;

use app\core\base\Controller;
use app\core\libs\Auth;
use app\models\User;
use app\models\Work;

class UserController extends AdminController
{
    public function indexAction()
    {
        if ($this->auth->role > 1) {
            redirect('/admin');
        }

        $users = User::where('username', '!=', 'admin')->get();

        $this->set(compact('users'));
    }

    public function createAction()
    {
        if ($this->auth->role > 1) {
            redirect('/admin');
        }

        if (!empty($_POST)) {
            $user = new User();

            if ($user->validate()) {

                User::add($_POST);
                redirect();

            } else {
                $user->getErrors();
                unset($_SESSION['oldData']);
                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }
    }

    public function editAction()
    {
        if ($this->auth->id !== $_GET['id']  || $this->auth->role > 1) {
            redirect('/admin');
        }
        if (!empty($_GET) && isset($_GET['id']) && (int)$_GET['id'] > 0) {

            $user = User::find($_GET['id']);
            $this->set(compact('user'));

        } elseif (!empty($_POST)) {

            $user = User::find($_POST['id']);

            if ($user->validate()) {

//                dd($user);
                $user->edit($_POST);
                $user->uploadImage('avatar');
                redirect();

            } else {
                $user->getErrors();
                $_SESSION['oldData'] = $_POST;
                $_GET['id'] = $user->id;
                redirect();

            };

        } else {
            redirect('/admin/thanks');
        }
    }

    public function destroyAction()
    {
        if ($this->auth->role > 1) {
            redirect('/admin');
        }
        User::find($_GET['id'])->remove();
        redirect();
    }


}