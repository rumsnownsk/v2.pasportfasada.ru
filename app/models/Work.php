<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'works';

    public static function checkPhoto($works){
        return collect($works)->each(function ($item){
            if (!file_exists(IMAGES.'/works/'.$item->photoName) || empty($item->photoName)){
                $item->photoName = 'no-photo.jpg';
            }
        });
    }
}