<?php

namespace app\controllers\admin;

use app\models\Thank;

class ThankController extends AdminController
{
    public function indexAction()
    {
        $thanks = Thank::all();
        $this->set(compact('thanks'));
    }

    public function createAction()
    {
        if (!empty($_POST)) {
            $thank = new Thank();

            if ($thank->validate()) {

                $thank = Thank::add($_POST);
                $thank->uploadImage('photo');
                redirect();

            } else {
                $thank->getErrors();
                unset($_SESSION['oldData']);
                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }
    }

    public function editAction()
    {
        if (!empty($_GET) && isset($_GET['id']) && (int)$_GET['id'] > 0 ) {

            $thank = Thank::find($_GET['id']);
            $this->set(compact('thank'));

        } elseif (!empty($_POST)) {

            $thank = Thank::find($_POST['id']);

            if ($thank->validate()){

                $thank->edit($_POST);
                $thank->uploadImage('photo');
                redirect();

            } else {
                $thank->getErrors();
                $_SESSION['oldData'] = $_POST;
                $_GET['id'] = $thank->id;
                redirect();

            };

        } else {
            redirect('/admin/thanks');
        }
    }

    public function destroyAction(){
        Thank::find($_GET['id'])->remove();
        redirect();
    }

//    public function clearimagesAction(){
//        $works = Work::all()->map(function ($item, $key){
//            return $item->photoName;
//        })->toArray();
//
//        $files = scandir(IMAGES.'/works');
//        foreach ($files as $file) {
//            if ($file == "." || $file==".."){
//                continue;
//            }
//            if(in_array($file, $works)){
//                continue;
//            } else {
//                unlink(IMAGES.'/works/'.$file);
//            };
//
//        }
//    }


}