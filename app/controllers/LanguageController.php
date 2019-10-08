<?php

namespace app\controllers;

use app\core\App;
use app\core\base\Controller;

class LanguageController extends Controller
{
    public function changeAction(){
        $lang = !empty($_GET['lang']) ? $_GET['lang'] : null;
        if ($lang){
            if (array_key_exists($lang, App::$app->getProperty('langs'))){
                setcookie('lang', $lang, time()+3600*24*7, '/');
            }
        }
        redirect();
    }
}