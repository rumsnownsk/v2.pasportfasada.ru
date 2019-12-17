<?php

namespace app\controllers\admin;

use app\core\base\Controller;
use app\core\libs\Auth;
use app\models\User;
use app\models\Work;

class UserController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        if ($this->auth->role > 1) {
            redirect('/admin');
        }
    }

    public function indexAction()
    {
        $title = "Работнички";
        $users = User::where('username', '!=', 'admin')->get();

        $this->render('admin/user/index', compact('users', 'title'));
    }

    public function createAction()
    {
        $title = "Создать работника";
        if (!empty($_POST)) {
            $user = new User();

            if ($user->validate()) {

                $user = User::add($_POST);
                $this->msg->success('Создан новый работник: '.$user->username. ' !!!');

                redirect('/admin/user');

            } else {
                $this->msg->error($user->getErrors());
                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }
        $this->render('admin/user/create', compact('title'));
    }


    public function editAction($id)
    {
        $title = "Редактировать работника";

        if (empty($_POST) && $user = User::find($id)) {
            $this->render('admin/user/edit', compact('title', 'user'));

        } elseif (!empty($_POST)) {

            $user = User::find($id);

            if ($user->validate(['password'])) {

                $user->edit($_POST);

                if (!$user->loadImage()){
                    $this->msg->warning($user->getErrors());
                };
                $this->msg->success('Работник: '.$user->username. ' отредактирован');

                redirect('/admin/user');

            } else {
                $this->msg->error($user->getErrors());
                $_SESSION['oldData'] = $_POST;
                redirect();
            };

        } else {
            redirect('/admin/user');
        }
    }

    public function destroyAction($id)
    {
        User::find($id)->remove();
        redirect();
    }


}