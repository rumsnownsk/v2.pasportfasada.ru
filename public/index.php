<?php
use app\core\Router;

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$query = trim($_SERVER['REQUEST_URI'], '/');

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('LIBS', dirname(__DIR__).'/core/libs');
define('CACHE', dirname(__DIR__).'/temp/cache');
define('DEBUG', true);
define('ADMIN', '/admin');
define('IMAGES', dirname(__DIR__).'/public/images');

require ROOT."/vendor/autoload.php";
require ROOT."/config/set_components.php";
require ROOT.'/app/core/libs/functions.php';

new \app\core\App();

//Router::addRoutes('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller'=> 'page']);
//Router::addRoutes('^page/(?P<alias>[a-z-]+)$', ['controller'=> 'page', 'action' => 'view']);

Router::addRoutes('^about$', ['controller'=> 'main', 'action' => 'about']);
//Router::addRoutes('^works/(?<alias>[a-z-])$', ['controller'=> 'main', 'action' => 'works']);
Router::addRoutes('^works$', ['controller'=> 'main', 'action' => 'works']);
Router::addRoutes('^thanks$', ['controller'=> 'main', 'action' => 'thanks']);
Router::addRoutes('^law$', ['controller'=> 'main', 'action' => 'law']);
Router::addRoutes('^contact$', ['controller'=> 'main', 'action' => 'contact']);
Router::addRoutes('^about$', ['controller'=> 'main', 'action' => 'about']);
Router::addRoutes('^map$', ['controller'=> 'main', 'action' => 'map']);
Router::addRoutes('^mail$', ['controller'=> 'main', 'action' => 'mail']);

// defaults routes
//Router::addRoutes('^admin$', ['controller'=> 'main', 'action'=>'index', 'prefix'=> 'admin']);
Router::addRoutes('^admin$', ['controller'=> 'work', 'action'=>'index', 'prefix'=> 'admin']);
Router::addRoutes('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

Router::addRoutes('^$', ['controller'=> 'main', 'action'=>'index']);
Router::addRoutes('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
