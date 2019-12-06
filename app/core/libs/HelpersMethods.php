<?php

namespace app\core\libs;


trait HelpersMethods
{
    public function randomString($length = 9) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function changeFormatDate($unixTime)
    {
        $d = date("d", $unixTime);

        $m = date("m", $unixTime);
        switch ($m) {
            case 1:
                $m = "января";
                break;
            case 2:
                $m = "февраля";
                break;
            case 3:
                $m = "марта";
                break;
            case 4:
                $m = "апреля";
                break;
            case 5:
                $m = "мая";
                break;
            case 6:
                $m = "июня";
                break;
            case 7:
                $m = "июля";
                break;
            case 8:
                $m = "августа";
                break;
            case 9:
                $m = "сентября";
                break;
            case 10:
                $m = "октября";
                break;
            case 11:
                $m = "ноября";
                break;
            case 12:
                $m = "декабря";
                break;
            default:
                $m = "none";
                break;
        }
        $y = date("Y", $unixTime);
        return "$d $m $y";
    }
}