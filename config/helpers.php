<?php

$settings = require ROOT . '/config/common.php';


function config($value)
{
    global $settings;
    return array_get($settings, $value);
}


// created constants
foreach ($settings['const'] as $k => $v) {
    define($k, $v);
}

function getPagination(\JasonGrimes\Paginator $paginator)
{
    include ROOT . '/vendor/jasongrimes/paginator/examples/pager.phtml';

}

function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }

    header("Location: $redirect");
    exit;
}

function oldInfo($field, $obj = false)
{
    if ($obj) {
        return $obj->$field;
    }
    return isset($_SESSION['oldData']) ? $_SESSION['oldData'][$field] : "";
}

function oldSelect($object, $field, $editObject = false)
{
//    dd($object, $field);
    if ($editObject && $editObject->$field == $object->id) {
        return "selected";
    }
    if (isset($_SESSION['oldData'][$field]) and $_SESSION['oldData'][$field] == $object->id) {
        return "selected";
    } else return "";
}

//function oldDate($field, $editObject = false)
//{
//    if ($editObject) {
//        return date('Y-m-d', $editObject->timeCreate);
//    }
//    return isset($_SESSION['oldData'][$field]) ? $_SESSION['oldData'][$field] : date('Y-m-d');
//}

function oldChecked($field, $editObject = false)
{
//    if ($editObject) {
//        return $editObject->publish == 1 ? "checked" : "";
//    }
    if (isset($_SESSION['oldData'][$field])) {
        return "checked";
    } else return "";
}

function roleSelect($field, $value, $obj)
{
    if ($obj->$field == $value) {
        return 'selected';
    } else return '';
}

function old($field)
{
    if (isset($_SESSION['oldData'])){
        $oldData = $_SESSION['oldData'];
    } else return null;

    if (key_exists($field, $oldData)){
        return $oldData[$field];


    }

//        dd($_SESSION['oldData']);
    return null;
//    $oldData = $_SESSION['oldData'];
}