<?php

use RedBeanPHP\R;

$db = [
    'dsn' => 'mysql:host=localhost; dbname=pf_nsk;charset=utf8',
    'user' => 'root',
    'pass' => 'root'
];

R::setup($db['dsn'], $db['user'], $db['pass']);
