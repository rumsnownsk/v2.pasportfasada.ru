<?php

return [
    'components' => [
        'cache' => 'app\core\libs\Cache',
//        'test' => 'app\core\libs\Test',
        'main' => 'app\models\Main'
    ],
    'settings' => [],
    'mail' => [
        'login' => 'asdfds', // your login from email
        'pass' => 'asdfasdf', // your password from email
        'mailServer' => 'smtp.yandex.ru',
        'port' => 465,
        'encryption' => 'SSL',
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'pf_nsk',
        'username' => 'root',
        'password' => 'root',
        'charset'=>'utf8',
        'collation'=>'utf8_unicode_ci',
        'prefix'    => ''
    ]
];
