<?php

function redirect( $http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
//    dump(phpinfo());
//    dd($http, $redirect);
    header("Location: $redirect");
    exit;
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function dateDMY($tUnix)
{
    return date("d-m-Y", $tUnix);
}

function oldInfo($field, $obj = false)
{
    if ($obj){
        return $obj->$field;
    }
    return isset($_SESSION['oldData']) ? $_SESSION['oldData'][$field] : "";
}

function roleSelect($field, $value, $obj){
    if ($obj->$field == $value){
        return 'selected';
    } else return '';
}


function oldSelect($objName, $field, $editObject = false)
{
//    dd($objName, $field);
    if ($editObject && $editObject->$field == $objName->id) {
        return "selected";
    }
    if (isset($_SESSION['oldData'][$field]) and $_SESSION['oldData'][$field] == $objName->id) {
        return "selected";
    } else return "";
}

function oldDate($field, $editObject = false)
{
    if ($editObject) {
        return date('Y-m-d', $editObject->timeCreate);
    }
    return isset($_SESSION['oldData'][$field]) ? $_SESSION['oldData'][$field] : date('Y-m-d');
}

function oldChecked($field, $editObject = false)
{
    if ($editObject) {
        return $editObject->publish == 1 ? "checked" : "";
    }
    if (isset($_SESSION['oldData'][$field]) and $_SESSION['oldData'][$field] == 'on') {
        return "checked";
    } else return "";
}