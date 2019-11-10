<?php

namespace app\controllers\admin;

use app\core\base\Controller;
use app\models\User;

class AdminController extends Controller
{
    public function __construct($route)
    {

        parent::__construct($route);
//        if (!User::isAdmin() && $route['action'] != 'login'){
//            redirect(ADMIN.'/user/login');
//        }
        $this->layout = 'admin';
    }
}