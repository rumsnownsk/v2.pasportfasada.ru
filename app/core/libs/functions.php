<?php

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

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function dateDMY($tUnix)
{
    return date("d-m-Y", $tUnix);
}

function oldData($param)
{
    return isset($_SESSION['oldData']) ? $_SESSION['oldData'][$param] : "";
}

function oldSelect($objName, $field)
{
    if (isset($_SESSION['oldData'][$field]) and $_SESSION['oldData'][$field] == $objName->id) {
        return "selected";
    } else return "";
}

function oldChecked($field)
{
    if (isset($_SESSION['oldData'][$field]) and $_SESSION['oldData'][$field] == 'on') {
        return "checked";
    } else return "";
}

function oldDate($field)
{
    return isset($_SESSION['oldData'][$field]) ? $_SESSION['oldData'][$field] : date('Y-m-d');
}