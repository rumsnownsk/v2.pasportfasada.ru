<?php
namespace app\controllers\admin;

use app\models\Category;
use app\models\Stage;
use app\models\Work;

class WorkController extends AdminController
{
    public function indexAction(){
        $works = Work::all();
        $this->set(compact('works'));
    }

    public function createAction(){
        $categories = Category::all();
        $stages = Stage::all();

        if (!empty($_POST)){

            $work = new Work();
            if (!$work->validate()){
                $work->getErrors();
                unset($_SESSION['oldData']);
                $_SESSION['oldData'] = $_POST;
                redirect();
            }

            $work->add($_POST);
        }

        $this->set(compact('categories', 'stages'));
    }




}