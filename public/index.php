<?php
use app\core\Router;

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$query = trim($_SERVER['REQUEST_URI'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('LIBS', dirname(__DIR__).'/core/libs');
define('CACHE', dirname(__DIR__).'/temp/cache');
define('DEBUG', true);


require_once "../vendor/autoload.php";
require_once "../config/config_db.php";

spl_autoload_register(function ($class){
    $file = ROOT.'/'. str_replace('\\', '/', $class).'.php';

    if (is_file($file)){
        require_once $file;
    }
});

new \app\core\App();

Router::addRoutes('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller'=> 'page']);
Router::addRoutes('^page/(?P<alias>[a-z-]+)$', ['controller'=> 'page', 'action' => 'view']);

// defaults routes
Router::addRoutes('^admin$', ['controller'=> 'User', 'action'=>'index', 'prefix'=> 'admin']);
Router::addRoutes('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

Router::addRoutes('^$', ['controller'=> 'main', 'action'=>'index']);
Router::addRoutes('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
//dd(Router::getRoutes());

Router::dispatch($query);
