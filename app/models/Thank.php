<?php

namespace app\models;

use app\core\libs\ImageManager;
use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class Thank extends Model
{
    protected $table = 'thanks';

    protected $fillable = [
        'title',
    ];

    public $image;
    public $errors = [];

    public $rules = [
        'required' => [
            ['title'],
        ]
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->image = new ImageManager();
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
            return true;

        } else {
            $this->errors = array_merge($this->image->err_upload, $v->errors());
            return false;
        }
    }

    public function uploadImage($fieldForm)
    {
        if ($this->image->validateImage($fieldForm)) {

            $this->image->delete('thanks', $this->imageName);
            $this->image->downloadImage($fieldForm, 'thanks');
            $this->imageName = $this->image->imageName;
            $this->save();
        }
    }

    public function getImageName()
    {
        return ImageManager::checkExistFile('thanks', $this->imageName)
            ? $this->imageName
            : 'no_image.png';
    }

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li> $item </li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }

    public function remove()
    {
        $this->image->delete('thanks', $this->imageName);
        $this->delete();
    }
}