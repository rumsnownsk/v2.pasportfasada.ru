<?php

return [
    'settings' => [],
    'mail' => [
        'login' => '', // your login from email
        'pass' => '', // your password from email
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
