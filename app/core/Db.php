<?php

namespace app\core;

//use PDO;

class Db
{
    use TSingleton;

    protected $pdo;
    public static $countSql = 0;
    protected static $queries = [];

    protected function __construct(){

    }

}