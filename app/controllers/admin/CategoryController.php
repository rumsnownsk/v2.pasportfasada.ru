<?php
namespace app\controllers\admin;

use app\models\Category;

class CategoryController extends AdminController
{
    public function indexAction(){
        $cats = Category::all();
        $this->set(compact('cats'));
    }

    public function createAction(){
        if (!empty($_POST)) {
            $category = new Category();

            if ($category->validate()) {
                Category::add($_POST);
                redirect('/admin/category');

            } else {
                $category->getErrors();
                unset($_SESSION['oldData']);
                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }
    }

    public function editAction(){
        if (!empty($_GET) && isset($_GET['id']) && (int)$_GET['id'] > 0) {

            $category = Category::find($_GET['id']);
            $this->set(compact('category'));

        } elseif (!empty($_POST)) {

            $category = Category::find($_POST['id']);

            if ($category->validate()){
                $category->edit($_POST);
                redirect('/admin/category');

            } else {
                $category->getErrors();
                $_SESSION['oldData'] = $_POST;
                $_GET['id'] = $_POST['id'];
                redirect();
            };

        } else {

            redirect('/admin');

        }
    }

    public function destroyAction(){
        Category::find($_GET['id'])->delete();
        redirect();
    }

}