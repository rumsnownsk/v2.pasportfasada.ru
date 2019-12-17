<?php

namespace app\models;

use app\core\libs\HelpersMethods;
use app\core\libs\ImgLoader;
use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class Work extends Model
{
    use HelpersMethods;

    protected $fillable = [
//        'photoName',
        'title',
        'category_id',
        'stage_id',
        'timeCreate',
        'publish',
        'description'
    ];

    public $rules = [
        'required' => [
            ['title'],
            ['category_id'],
            ['stage_id'],
            ['timeCreate'],
        ]
    ];

    protected $table = 'works';

    public $errors = array();
    public $imgLoader;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->imgLoader = new ImgLoader();
    }

    public static function add($fields)
    {
        $work = new static;
        $work->fill($fields);
        $work->save();
        return $work;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        return $this->save();
    }

    public function setStage()
    {
        if (isset($_POST['stage_id'])) {
            $this->stage_id = (integer)$_POST['stage_id'];
            $this->save();
        }
    }

    public function setTimeCreate()
    {
        if (isset($_POST['timeCreate'])) {
            $this->timeCreate = strtotime($_POST['timeCreate']);
//            dd($this->timecreate);
            $this->save();
        }
    }

    public function setPublish()
    {
        if (isset($_POST['publish'])) {
            $this->publish = 1;
        } else {
            $this->publish = 0;
        }
        $this->save();
    }

    public function setDescription()
    {
        if (isset($_POST['description'])) {
            $this->description = $_POST['description'];
            $this->save();
        }
    }

//    public function setImageName()
//    {
////        dump()
//        if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
////            dd($_FILES['photo']);
//            $filePath = $_FILES['photo']['tmp_name'];
//
//            $image = getimagesize($filePath);
//            $name = $this->randomString();
//            $extension = image_type_to_extension($image[2]);
//
//            $this->imageName = $name . $extension;
//        } else {
//            $this->imageName = $_POST['photoName'] ?: "no-photo.jpg";
//
//        }
//        return $this->imageName;
//    }

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
        if ($this->imgLoader->validateImage('photoName')) {

            $this->imgLoader->delete('works', $this->photoName);

            $this->photoName = $this->imgLoader->uploadImage($_FILES['photoName']);

            $this->save();
            return true;

        } else {
            $this->errors = array_merge($this->errors, $this->imgLoader->errors);
            return false;
        }
    }

    public function uploadImage($fieldForm)
    {
        if ($this->image->validateImage($fieldForm)) {

            $this->image->delete('works', $this->photoName);
            $this->image->downloadImage($fieldForm, 'works');
            $this->photoName = $this->image->imageName;
            $this->save();
        }
    }

    public function getImage()
    {
        if (!file_exists(IMAGES . '/works/' . $this->photoName) || empty($this->photoName)) {
            return '/images/no_photo.jpg';
        }
        return '/images/works/' . $this->photoName;
    }

    public function getCategory()
    {
        if ($cat = Category::where("id", $this->category_id)->first()) {
            return $cat->title;
        }
        return null;
    }

    public function getStage()
    {
        if ($s = Stage::where("id", $this->stage_id)->first()) {
            return $s->name;
        }
        return null;
    }

    public function getPublish()
    {
        switch ($this->publish) {
            case 0 :
                return '<i class="fa fa-ban fa_size" aria-hidden="true" style="color:red;"></i>';
                break;
            case 1 :
                return '<i class="fa fa-check fa_size" aria-hidden="true" style="color:limegreen"></i>';
                break;
            default:
                return null;
        }
    }

    public function remove()
    {
        $this->imgLoader->delete('works', $this->photoName);
        $this->delete();
    }
}