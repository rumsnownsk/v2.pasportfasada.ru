<?php

namespace app\controllers\admin;

use app\core\base\Controller;
use app\core\libs\Auth;
use app\models\User;

class AdminController extends Controller
{

    public function __construct($route)
    {
        if (!isset($_SESSION['auth'])){
            redirect('/');
        }

        parent::__construct($route);

        $this->layout = 'admin';
    }
}