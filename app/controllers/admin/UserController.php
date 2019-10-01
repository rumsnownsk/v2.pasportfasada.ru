<?php

namespace app\controllers\admin;

use app\core\base\View;

class UserController extends CommonController
{
    public function indexAction(){
        $this->layout = 'default';

        $this->setMeta('Админка', 'Описание админки', 'Keywords for admin');
        $users = 'Директор';
        $this->set(compact('users'));
    }

    public function testAction(){
        $this->layout = 'admin';

        echo __METHOD__;
    }
}