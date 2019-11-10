<?php

namespace app\controllers\admin;

use app\models\Category;
use app\models\Stage;
use app\models\Work;

class WorkController extends AdminController
{
    public function indexAction()
    {
        $works = Work::all();
        $this->set(compact('works'));
    }

    public function createAction()
    {
        $categories = Category::all();
        $stages = Stage::all();

        if (!empty($_POST)) {
            $work = new Work();

            if (!$work->validate()) {
                $work->getErrors();
                unset($_SESSION['oldData']);
                $_SESSION['oldData'] = $_POST;
                redirect();
            }

            $work->add($_POST);
        }

        $this->set(compact('categories', 'stages'));
    }

    public function editAction()
    {
        $categories = Category::all();
        $stages = Stage::all();

        if (isset($_GET['id']) && (int)$_GET['id'] > 0 && $work = Work::find($_GET['id'])) {

            $this->set(compact('work', 'categories', 'stages'));

        } elseif (!empty($_POST)) {

            $work = new Work();

            if (!$work->validate()){

                $work->getErrors();
                $_SESSION['oldData'] = $_POST;
                $_GET['id'] = 1;
                redirect();
            } else {
                $work = Work::find($_POST['id']);
                $work->edit($_POST);
            };

            $this->set(compact('work','categories', 'stages'));

        } else {
            redirect('/admin');
        }
    }

    public function updateAction()
    {

    }


}