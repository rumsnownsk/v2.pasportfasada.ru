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
        $this->render('admin/work/index', compact('works'));
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

                $this->msg->success('Объект '.$work->title. ' успешно добавлен!');

                redirect('/admin');
            } else {
                $this->msg->error($work->getErrors());
                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }

        $this->render('admin/work/create', compact('categories', 'stages'));
    }


    public function editAction($id)
    {
        $categories = Category::all();
        $stages = Stage::all();

        if (empty($_POST) && $work = Work::find($id)) {

            $this->render("admin/work/edit", compact('work', 'categories', 'stages'));

        } elseif (!empty($_POST)) {

            $work = Work::find($id);

            if ($work->validate()){

                $work->edit($_POST);
                $work->setStage();
                $work->setTimeCreate();
                $work->setPublish();
                $work->setDescription();
                $work->uploadImage('photo');

                $this->msg->success('Объект: '.$work->title. 'успешно отредактирован');

                redirect('/admin');

            } else {
                $this->msg->error($work->getErrors());
                $_SESSION['oldData'] = $_POST;
                redirect();
            };

        } else {
            redirect('/admin');
        }
    }

    public function destroyAction($id = null){
        Work::find($id)->remove();
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