<?php

return [
    'settings' => [],
    'mail' => [
        'login' => 'semenovra-es@yandex.ru', // your login from email
        'pass' => 'mJ7-qyg-Jz9-7q7', // your password from email
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
