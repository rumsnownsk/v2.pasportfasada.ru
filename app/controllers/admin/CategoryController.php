<?php
namespace app\controllers\admin;

class CategoryController extends CommonController
{
    public function indexAction(){

        echo 'get ALL categories in method - '.__METHOD__ ;
    }

    public function createAction(){
        echo 'page of view for create NEW category';
    }
}