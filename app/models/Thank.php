<?php

namespace app\models;

use app\core\libs\HelpersMethods;
use app\core\libs\ImgLoader;
use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class Thank extends Model
{
    use HelpersMethods;

    protected $table = 'thanks';

    protected $fillable = [
        'title',
    ];

    public $imgLoader;
    public $errors = [];

    public $rules = [
        'required' => [
            ['title'],
        ]
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->imgLoader = new ImgLoader();
    }

    public static function add($fields)
    {
        $thanks = new static;
        $thanks->fill($fields);
        $thanks->save();
        return $thanks;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        return $this->save();
    }

    public function validate()
    {
        $v = new Validator($_POST);
        $v->rules($this->rules);

        if ($v->validate()) {
            if (isset($_SESSION['oldData'])) {
                unset($_SESSION['oldData']);
            };
            return true;

        } else {
            $this->errors = array_merge($this->errors, $v->errors());
            return false;
        }
    }

    public function loadImage()
    {
        if ($this->imgLoader->validateImage('image')) {

            $this->imgLoader->delete('thanks', $this->image);

            $this->image = $this->imgLoader->uploadImage($_FILES['image'], 'thanks');

            $this->save();
            return true;

        } else {
            $this->errors = array_merge($this->errors, $this->imgLoader->errors);
            return false;
        }
    }



//    public function uploadImage($fieldForm)
//    {
//        if ($this->image->validateImage($fieldForm)) {
//
//            $this->image->delete('thanks', $this->imageName);
//            $this->image->downloadImage($fieldForm, 'thanks');
//            $this->imageName = $this->image->imageName;
//            $this->save();
//        }
//    }
    public function getImage()
    {
        if (!file_exists(IMAGES . '/thanks/' . $this->image) || empty($this->image)) {
            return '/images/no_image.png';
        }
        return '/images/thanks/' . $this->image;
    }

    public function remove()
    {
        $this->imgLoader->delete('thanks', $this->imageName);
        $this->delete();
    }
}