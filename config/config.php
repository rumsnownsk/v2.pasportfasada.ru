<?php

return [
    'components' => [
        'cache' => 'app\core\libs\Cache',
//        'test' => 'app\core\libs\Test',
        'main' => 'app\models\Main'
    ],
    'settings' => [],
    'mail' => [
        'login' => 'semenovra-es@ya.ru',
        'pass' => 'vit@inm0tum',
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
