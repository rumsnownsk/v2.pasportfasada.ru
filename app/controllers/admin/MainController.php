<?php

namespace app\controllers\admin;


use app\core\base\Controller;
use app\models\Work;

class MainController extends CommonController
{
    public function indexAction(){
        $works = Work::all();
        $this->set(compact('works'));

    }

}