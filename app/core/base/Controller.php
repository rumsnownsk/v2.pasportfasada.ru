<?php

namespace app\core\base;

use app\core\libs\HelpersMethods;
use app\models\User;
use DI\DependencyException;
use DI\NotFoundException;
use League\Plates\Engine;

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
    public $msg;


    use HelpersMethods;

    public function __construct()
    {
        unset($_SESSION['oldData']);
        global $container;

        $this->msg = new \Plasticbrain\FlashMessages\FlashMessages();

        try {
            $this->view = $container->get(Engine::class);
        } catch (DependencyException $e) {
            echo 'DependencyException: ' . $e->getMessage();
        } catch (NotFoundException $e) {
            echo 'NotFoundException: ' . $e->getMessage();
        }

        $this->vars['meta'] = $this->meta;
        $this->vars['errors'] = $this->errors;
        $this->vars['msg'] = $this->msg;

        if (isset($_SESSION['auth'])) {
            $this->auth = (new User())->setRawAttributes($_SESSION['auth']);
            $this->vars['auth'] = $this->auth;
        };

        if (isset($_SESSION['oldData'])){
            $this->vars['oldData'] = $_SESSION['oldData'];
        }
    }

    public function render($pathToView, array $data = array())
    {
        $data = array_merge($this->vars, $data);
//        dd($data);
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