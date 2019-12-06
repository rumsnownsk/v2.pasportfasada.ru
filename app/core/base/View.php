<?php

namespace app\core\base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    /**
     * текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    public $route = [];

    /**
     * текущий вид
     * @var string
     */
    public $view;

    public $data;

    /**
     * текущий шаблон
     * @var string
     */
    public $layout = 'main';

    public $scripts;

    public $loader;

//    public function __construct($route, $layout = '', $view = '')
    public function __construct()
    {
//        $this->twig = new Environment($loader, [
//            'cache' => false,
//            'debug' => true
//        ]);


//        $this->route = $route;
//
//        if ($layout === false) {
//            $this->layout = false;
//        } else {
//            $this->layout = $layout ?: $this->layout;
//        }
//
//        $this->view = $view;
        $loader = new FilesystemLoader(APP.'/views');
        $twig = new Environment($this->loader, [
            'cache' => false,
        ]);
    }

    public function render($filename, $data){
        if (is_array($data)) {
            extract($data);
            $this->data = $data;
        }

    }

    protected function compressPage($buffer)
    {
//        return $buffer;
        $search = [
            "/(\n)+/",
            "/\r\n+/",
            "/\n(\t)+/",
            "/\n(\ )+/",
            "/\>(\n)+</",
            "/\>\r\n</"
        ];
        $replace = [
            "\n",
            "\n",
            "\n",
            "\n",
            '><',
            '><'
        ];
        return preg_replace($search, $replace, $buffer);
    }

    /**
     * @param $data
     * @throws \Exception
     */
//    public function render($data)
//    {
////        Lang::load(App::$app->getProperty('lang'), $this->route);
//
//        if (is_array($data)) {
//            extract($data);
//            $this->data = $data;
//        }
//
//        $prefix = str_replace("\\", "/", $this->route['prefix']);
//        $file_view = APP . "/views/" . $prefix . "{$this->route['controller']}/{$this->view}.php";
//
//        header("Content-Encoding: UTF8");
//
//        {
//            if (file_exists($file_view)) {
//
//                if ($this->layout == false) {
//                    require $file_view;
//                    exit;
//                }
////                ob_start();
////                ob_start('ob_gzhandler');
//                ob_start([$this, 'compressPage']);
//
//                require $file_view;
//
//                $content = ob_get_clean();
////                $content = ob_get_contents();
////                ob_clean();
//
//
//            } else {
//                throw new \Exception("файл ВИДА <b>$file_view</b> - not found ", 404);
//            }
//
//        }
//
//
//        $file_layout = APP . "/views/layouts/{$this->layout}.php";
//
//        if (file_exists($file_layout)) {
//            $content = $this->getScript($content);
//            $scripts = [];
//
//            if (!empty($this->scripts[0])) {
//                $scripts = $this->scripts[0];
//            }
//            include $file_layout;
//
//        } else {
//            throw new \Exception("файл ШАБЛОНА <b>{$file_layout}</b> - not found ", 404);
//        }
//    }

    protected function getScript($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
//        dd(!empty($this->scripts));
        if (!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public function getPart($file)
    {
        extract($this->data);

        $file = APP . "/views/{$file}.php";

        if (is_file($file)) {
            require_once $file;
        } else {
            throw new \Exception("подключаемый файл <b>{$file}</b> - not found ", 404);
        }
    }
}