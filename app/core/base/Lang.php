<?php

namespace app\core\base;


class Lang
{
    public static $lang_data = []; //массив со всеми переведёнными фразами

    public static $lang_layout = []; // массив со всеми переведёнными фразами ДЛЯ ШАБЛОНА

    public static $lang_view = []; //массив со всеми переведёнными фразами ДЛЯ ВИДА

    public static function load($code, $view){
        $lang_layout = APP."/langs/{$code['code']}.php";
        $lang_view = APP."/langs/{$code['code']}/{$view['controller']}/{$view['action']}.php";
        if (file_exists($lang_layout)){
            self::$lang_layout = require_once $lang_layout;
        }
        if (file_exists($lang_view)){
            self::$lang_view = require_once $lang_view;
        }

        self::$lang_data = array_merge(self::$lang_layout, self::$lang_view);
//        dd(self::$lang_data);
    }

    public static function get($key){
        return isset(self::$lang_data[$key])? self::$lang_data[$key] : $key ;
    }
}