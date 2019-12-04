<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Соедитение с Базой Данных
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => config('database.driver'),
    'host' => config('database.host'),
    'database' => config('database.dbname'),
    'username' => config('database.username'),
    'password' => config('database.password'),
    'charset' => config('database.charset'),
    'collation' => config('database.collation'),
    'prefix' => config('database.prefix')
]);
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
