<?php

return [
    'const' => [
        'DEBUG' => false,
        'ADMIN' => '/admin',
        'IMAGES' => dirname(__DIR__).'/images',
    ],
    'settings' => [],
    'mail' => [
        'login' => 'semenovra-es@ya.ru',
        'pass' => '',
        'mailServer' => 'smtp.yandex.ru',
        'port' => 465,
        'encryption' => 'SSL',
    ],
    'database' => [
        'driver' => 'mysql',
        'host' => '',
        'dbname' => '',
        'username' => '',
        'password' => '',
        'charset'=>'utf8',
        'collation'=>'utf8_unicode_ci',
        'prefix'    => ''
    ]
];
