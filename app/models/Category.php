<?php

namespace app\models;

use app\core\libs\HelpersMethods;
use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class Category extends Model
{
    use HelpersMethods;

    protected $table = 'categories';
    public $timestamps = false;

    public $fillable = [
        'title'
    ];

    public $errors = [];

    public $rules = [
        'required' => [
            ['title'],
        ]
    ];

    public function validate(){
        $v = new Validator($_POST);
        $v->rules($this->rules);
        if ($v->validate()){
            if (isset($_SESSION['oldData'])) {
                unset($_SESSION['oldData']);
            };
            return true;
        } else {
            $this->errors = $v->errors();
            return false;
        }
    }

    public static function add($fields){
        $category = new static();
        $category->fill($fields);
        $category->save();
    }

    public function edit($fields){
        $this->fill($fields);
        $this->save();
    }
}