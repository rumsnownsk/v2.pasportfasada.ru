<?php

namespace app\core\base;

use app\core\App;
use app\core\Registry;

abstract class Controller
{
    public $pathToView = [];

    /**
     * текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    public $route = [];

    /**
     * вид
     * @var string
     */
    public $view;

    /**
     * базовый шаблон
     * @var string
     */
    public $layout;

    /**
     * данные для View
     * @var array
     */
    public $vars = array();

    public $meta = [
        'title' => '',
        'description' => '',
        'keywords' => ''
    ];

    public $app;


    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
        $this->app = Registry::instance();

//        App::$app->setProperty('langs', Language::getLanguages());
//        App::$app->setProperty('lang', Language::getLanguage(App::$app->getProperty('langs')));

        $this->vars['meta'] = $this->meta;
    }

    public function getView()
    {
//        dd($this->vars);
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    public function set($data)
    {
        $this->vars = array_merge($this->vars, $data);
    }

    public function setMeta($title='', $description='', $keywords=''){
        $this->vars['meta']['title'] = $title;
        $this->vars['meta']['description'] = $description;
        $this->vars['meta']['keywords'] = $keywords;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public function loadView($view, $vars = []){
        extract($vars);
        require APP."/views/{$this->route['controller']}/{$view}.php";
    }
}