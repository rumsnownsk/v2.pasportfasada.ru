<?php
namespace app\controllers\admin;

use app\models\Category;

class CategoryController extends AdminController
{
    public function indexAction(){
        $categories = Category::all();
        $this->render('admin/category/index', compact('categories'));
    }

    public function createAction(){
        $title = "Добавление категории";
        if (!empty($_POST)) {
            $category = new Category();

            if ($category->validate()) {
                Category::add($_POST);
                $this->msg->success('Добавлена новая категория');

                redirect('/admin/category');

            } else {
                $this->msg->error($category->getErrors());
                $_SESSION['oldData'] = $_POST;
                redirect();
            }
        }

        $this->render('admin/category/create', compact('title'));
    }

    public function editAction($id){
        $title = "Редактирование категории";

        if (empty($_POST) && $category = Category::find($id)) {

            $this->render("admin/category/edit", compact('category', 'title'));

        } elseif (!empty($_POST)) {

            $category = Category::find($id);

            if ($category->validate()){
                $category->edit($_POST);
                $this->msg->success('Категория успешно отредактирована');

                redirect('/admin/category');

            } else {
                $this->msg->error($category->getErrors());
                $_SESSION['oldData'] = $_POST;
                redirect('/admin/category');
            };

        } else {
            redirect('/admin');
        }
    }

    public function destroyAction($id){
        Category::find($id)->delete();
        redirect();
    }

}