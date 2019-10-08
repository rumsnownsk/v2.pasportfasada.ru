<?php

namespace app\core;

class Registry {

    use TSingleton;

    protected static $properties = [];

    public function setProperty($name, $value){
        self::$properties[$name] = $value;
    }

    public function getProperty($name){
        if(isset(self::$properties[$name])){
            return self::$properties[$name];
        } else
            return null;
    }

    public function getProperties(){
        return self::$properties;
    }


}
