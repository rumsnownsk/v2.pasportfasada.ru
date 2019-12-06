<?php

// Настройки DI
use DI\ContainerBuilder;
use League\Plates\Engine;

new app\core\ErrorHandler();

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function(){
        return new Engine(VIEWS);
    },

]);
$container = $containerBuilder->build();



// Настройки Роутера
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
//    $r->addRoute('GET', '/', 'get_all_users_handler');
    $r->addRoute('GET', '/', ['app\controllers\MainController', 'indexAction']);
    $r->addRoute('GET', '/works[/{cat_id:\d+}]', ['app\controllers\MainController', 'worksAction']);

//    $r->addRoute('GET', '/works[/{id:\d+}]', function ($id){
//        return $id;
//    });

    $r->addRoute('GET', '/thanks', ['app\controllers\MainController', 'thanksAction']);
    $r->addRoute('GET', '/law', ['app\controllers\MainController', 'lawAction']);
    $r->addRoute('GET', '/contact', ['app\controllers\MainController', 'contactAction']);
    $r->addRoute('GET', '/about', ['app\controllers\MainController', 'aboutAction']);

    $r->addRoute('GET', '/captcha', ['app\controllers\MainController', 'captchaAction']);
    $r->addRoute('GET', '/recall', ['app\controllers\MainController', 'recallAction']);

//    $r->addRoute('GET', '/{id}', ['app\controllers\MainController', 'index']);
//    $r->addRoute('GET', '/roga', ['app\controllers\MainController', 'index']);
//    $r->addRoute('GET', '/law', ['app\controllers\MainController', 'law']);
//     {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//     The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // ... call $handler with $vars
//dd($handler, $vars);

//        $container = new Container();

        $container->call($handler, $vars);

        break;
}