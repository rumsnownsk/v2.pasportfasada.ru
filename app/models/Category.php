<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class Category extends Model
{
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

    public function getErrors(){
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li> $item </li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }
}