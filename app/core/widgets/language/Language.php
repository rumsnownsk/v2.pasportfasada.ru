<?php

namespace app\core\widgets\language;

use app\core\App;
use app\models\Language as L;

class Language
{
    protected $tpl;
    protected $languages;
    protected $language;

    public function __construct()
    {
        $this->tpl = __DIR__.'/lang_tpl.php';
        $this->run();
    }

    protected function run(){
        $this->languages = App::$app->getProperty('langs');
        $this->language = App::$app->getProperty('lang');
        echo $this->getHtml();
    }

    public static function getLanguages(){
        return L::all('base', 'code', 'title')->keyBy('code')->sortKeys()->toArray();
    }

    public static function getLanguage($languages){
        if (isset($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], $languages)){
            $key = $_COOKIE['lang'];
        } else {
            $key = key($languages);
        }
        $lang = $languages[$key];
        return $lang;
    }

    protected function getHtml(){
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}