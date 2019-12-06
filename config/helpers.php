<?php

$settings = require ROOT.'/config/common.php';


function config($value){
    global $settings;
    return array_get($settings, $value);
}


// created constants
foreach ($settings['const'] as $k => $v) {
    define($k, $v);
}

function getPagination(\JasonGrimes\Paginator $paginator)
{
    include ROOT.'/vendor/jasongrimes/paginator/examples/pager.phtml';

}
