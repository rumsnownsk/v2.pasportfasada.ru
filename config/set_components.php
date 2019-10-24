<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$settings = require ROOT . "/config/config.php";
$db = $settings['db'];
$mail = $settings['mail'];


// Соедитение с Базой Данных

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => $db['driver'],
    'host' => $db['host'],
    'database' => $db['database'],
    'username' => $db['username'],
    'password' => $db['password'],
    'charset' => $db['charset'],
    'collation' => $db['collation'],
    'prefix' => $db['prefix']
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


// Настройки отправки почты



//$mailer = new
