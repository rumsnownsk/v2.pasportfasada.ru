<?php

namespace app\controllers\admin;

use app\core\libs\HelpersMethods;
use app\models\Thank;

class ThankController extends AdminController
{
    public function indexAction()
    {
        $thanks = Thank::all();
        $this->render('admin/thank/index', compact('thanks'));
    }

    public function createAction()
    {
        if (!empty($_POST)) {
            $thank = new Thank();

            if ($thank->validate()) {

                $thank = Thank::add($_POST);
                $thank->uploadImage('photo');

                $this->msg->success('Новая благодарность успешно добавлена');

                redirect('/admin/thank');

            } else {
                $this->msg->error($thank->getErrors());

                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }
        $this->render('admin/thank/create');
    }

    public function editAction($id)
    {
        if (empty($_POST) && $thank = Thank::find($id) ) {

            $this->render("admin/thank/edit", compact('thank'));


        } elseif (!empty($_POST)) {

            $thank = Thank::find($id);

            if ($thank->validate()){

                $thank->edit($_POST);
                $thank->uploadImage('photo');

                $this->msg->success('Благодарность успешно отредактирована');

                redirect();

            } else {
                $this->msg->error($thank->getErrors());

                $_SESSION['oldData'] = $_POST;

                redirect('/admin/thank');
            };

        } else {
            redirect('/admin/thanks');
        }
    }

    public function destroyAction($id){
        Thank::find($id)->remove();
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