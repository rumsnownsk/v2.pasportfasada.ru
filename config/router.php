<?php

// Настройки DI
use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use League\Plates\Engine;

new app\core\ErrorHandler();

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function () {
        return new Engine(VIEWS);
    },

]);
try {
    $container = $containerBuilder->build();
} catch (Exception $e) {
    echo 'ContainerBuilder error: ' . $e->getMessage();
}


// Настройки Роутера
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
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
    $r->addRoute('POST', '/recall', ['app\controllers\MainController', 'recallAction']);

    $r->addGroup('/admin', function (RouteCollector $r) {
        $r->addRoute('GET', '', ['app\controllers\admin\WorkController', 'indexAction']);
        $r->addRoute(['GET', 'POST'], '/work/create', ['app\controllers\admin\WorkController', 'createAction']);
        $r->addRoute(['GET', 'POST'], '/work/{id:\d+}/edit', ['app\controllers\admin\WorkController', 'editAction']);
        $r->addRoute('GET', '/work/{id:\d+}/destroy', ['app\controllers\admin\WorkController', 'destroyAction']);

        $r->addRoute('GET', '/thank', ['app\controllers\admin\ThankController', 'indexAction']);
        $r->addRoute(['GET', 'POST'], '/thank/create', ['app\controllers\admin\ThankController', 'createAction']);
        $r->addRoute(['GET', 'POST'], '/thank/{id:\d+}/edit', ['app\controllers\admin\ThankController', 'editAction']);
        $r->addRoute('GET', '/thank/{id:\d+}/destroy', ['app\controllers\admin\ThankController', 'destroyAction']);

        $r->addRoute('GET', '/category', ['app\controllers\admin\CategoryController', 'indexAction']);
        $r->addRoute(['GET', 'POST'], '/category/create', ['app\controllers\admin\CategoryController', 'createAction']);
        $r->addRoute(['GET', 'POST'], '/category/{id:\d+}/edit', ['app\controllers\admin\CategoryController', 'editAction']);
        $r->addRoute('GET', '/category/{id:\d+}/destroy', ['app\controllers\admin\CategoryController', 'destroyAction']);

        $r->addRoute('GET', '/user', ['app\controllers\admin\UserController', 'indexAction']);
        $r->addRoute(['GET', 'POST'], '/user/create', ['app\controllers\admin\UserController', 'createAction']);
        $r->addRoute(['GET', 'POST'], '/user/{id:\d+}/edit', ['app\controllers\admin\UserController', 'editAction']);
        $r->addRoute('GET', '/user/{id:\d+}/destroy', ['app\controllers\admin\UserController', 'destroyAction']);

//        $r->addRoute('GET', '/clearimages', ['app\controllers\admin\WorkController', 'clearimagesAction']);

    });

    $r->addGroup('/auth', function (RouteCollector $r) {
        $r->addRoute(['GET', 'POST'], '', ['app\controllers\AuthController', 'loginAction']);
        $r->addRoute('GET', '/logout', ['app\controllers\AuthController', 'logoutAction']);
    });

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
//dump(FastRoute\Dispatcher::NOT_FOUND);
//dump(FastRoute\Dispatcher::METHOD_NOT_ALLOWED);
//dd($routeInfo);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "NOT_FOUND - странно, вы не должны были сюда попасть";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "METHOD_NOT_ALLOWED - странно, вы не должны были сюда попасть";
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