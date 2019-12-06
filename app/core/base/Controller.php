<?php

namespace app\core\base;

use app\core\libs\HelpersMethods;
use app\models\User;
use League\Plates\Engine;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\CoreExtension;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    public $vars = array();
    public $errors = array();

    public $meta = [
        'titlePage' => '',
        'description' => '',
        'keywords' => ''
    ];

    public $auth;

    public $loader;
    public $view;


    use HelpersMethods;

    public function __construct(Engine $view)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->view = $view;

        $this->vars['meta'] = $this->meta;
        $this->vars['errors'] = $this->errors;

        if (isset($_SESSION['auth'])) {
            $this->auth = (new User())->setRawAttributes($_SESSION['auth']);
            $this->vars['auth'] = $this->auth;
        };
    }

    public function render($pathToView, array $data = array())
    {
        $data = array_merge($this->vars, $data);

        echo $this->view->render($pathToView, $data);
    }

    public function setMeta(array $meta = array()){
        foreach ($meta as $k => $v){
            $this->vars['meta'][$k] = $v;
        }
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}