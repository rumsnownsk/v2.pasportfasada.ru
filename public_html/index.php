<?php

define('ROOT', dirname(__DIR__));   //  /var/www/v2.pasportfasada.ru

require ROOT.'/vendor/autoload.php';
require ROOT.'/config/helpers.php';
require ROOT.'/config/db.php';
require ROOT.'/config/router.php';

/*




Router::addRoutes('^$', ['controller'=> 'main', 'action' => 'plug']);
Router::addRoutes('^$', ['controller'=> 'main', 'action'=>'index']);
Router::addRoutes('^about$', ['controller'=> 'main', 'action' => 'about']);
Router::addRoutes('^works$', ['controller'=> 'main', 'action' => 'works']);
Router::addRoutes('^thanks$', ['controller'=> 'main', 'action' => 'thanks']);
Router::addRoutes('^law$', ['controller'=> 'main', 'action' => 'law']);
Router::addRoutes('^contact$', ['controller'=> 'main', 'action' => 'contact']);
Router::addRoutes('^about$', ['controller'=> 'main', 'action' => 'about']);
Router::addRoutes('^map$', ['controller'=> 'main', 'action' => 'map']);

Router::addRoutes('^auth$', ['controller'=> 'auth', 'action' => 'login']);



//for Ajax queries
Router::addRoutes('^recall$', ['controller'=> 'main', 'action' => 'recall']);
Router::addRoutes('^captcha', ['controller'=> 'main', 'action' => 'captcha']);

// defaults routes
Router::addRoutes('^admin$', ['controller'=> 'work', 'action'=>'index', 'prefix'=> 'admin']);
Router::addRoutes('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

Router::addRoutes('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
