<?php

namespace app\controllers\admin;

use app\core\base\Controller;

class CommonController extends Controller
{
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);
    }
}