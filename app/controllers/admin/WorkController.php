<?php

namespace app\controllers\admin;

use app\models\Category;
use app\models\Stage;
use app\models\Work;

class WorkController extends AdminController
{
    public function indexAction()
    {
//        dd($this->auth);
//        $auth = $this->auth;
        $works = Work::all();
        $this->set(compact('works'));
    }

    public function createAction()
    {
        $categories = Category::all();
        $stages = Stage::all();

        if (!empty($_POST)) {
            $work = new Work();

            if ($work->validate()) {
                $work = Work::add($_POST);
                $work-> setStage();
                $work-> setTimeCreate();
                $work-> setPublish();
                $work-> setDescription();
                $work-> uploadImage('photo');
                redirect();

            } else {
                $work->getErrors();
                unset($_SESSION['oldData']);
                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }

        $this->set(compact('categories', 'stages'));
    }


    public function editAction()
    {
        $categories = Category::all();
        $stages = Stage::all();

        if (!empty($_GET) && isset($_GET['id']) && (int)$_GET['id'] > 0) {

            $work = Work::find($_GET['id']);
            $this->set(compact('work', 'categories', 'stages'));

        } elseif (!empty($_POST)) {

            $work = Work::find($_POST['id']);

            if ($work->validate()){

//                dd($work);
                $work->edit($_POST);
                $work->setStage();
                $work->setTimeCreate();
                $work->setPublish();
                $work->setDescription();
                $work->uploadImage('photo');
                redirect();

            } else {
                $work->getErrors();
                $_SESSION['oldData'] = $_POST;
                $_GET['id'] = $_POST['id'];
                redirect();
            };

            $this->set(compact('work','categories', 'stages'));

        } else {
            redirect('/admin');
        }
    }

    public function destroyAction(){
        Work::find($_GET['id'])->remove();
        redirect();
    }

//    public function clearimagesAction(){
//        $works = Work::all()->map(function ($item, $key){
//            return $item->photoName;
//        })->toArray();
//
//        $files = scandir(IMAGES.'/thanks');
//        foreach ($files as $file) {
//            if ($file == "." || $file==".."){
//                continue;
//            }
//            if(in_array($file, $works)){
//                continue;
//            } else {
//                unlink(IMAGES.'/thanks/'.$file);
//            };
//
//        }
//    }


}