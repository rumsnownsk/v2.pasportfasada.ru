<?php

//use RedBeanPHP\R;
//
//$db = [
//    'dsn' => 'mysql:host=localhost; dbname=pf_nsk;charset=utf8',
//    'user' => 'root',
//    'pass' => 'root'
//];
//
//R::setup($db['dsn'], $db['user'], $db['pass']);


use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'pf_nsk',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();