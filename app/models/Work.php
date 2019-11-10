<?php

namespace app\models;

use app\core\libs\HelpersMethods;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Image;
use Valitron\Validator;

class Work extends Model
{
    use HelpersMethods;

    protected $fillable = [
        'photoName',
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
    public $errors = [];

    public $imageName;

    public function add($fields){
        $fields['photoName'] = $this->setImageName();
        $fields['category_id'] = (integer)$fields['category_id'];
        $fields['stage_id'] = (integer)$fields['stage_id'];
        $fields['publish'] = isset($fields['publish']) ? 1 : 0;
        $fields['timeCreate'] = (integer)strtotime($fields['timeCreate']);

        $work = new static;
        $work->fill($fields);
        if ($work->save()){
            $this->uploadPhoto();
        };
    }

    public function edit($fields){
        $fields['photoName'] = $this->setImageName();

        $fields['publish'] = isset($fields['publish']) ? 1 : 0;
        $fields['category_id'] = (integer)$fields['category_id'];
        $fields['stage_id'] = (integer)$fields['stage_id'];
        $fields['timeCreate'] = (integer)strtotime($fields['timeCreate']);

        $this->fill($fields);
        if ($this->save()) {
            $this->uploadPhoto();
        };
    }

    public function setImageName(){
//        dump()
        if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])){
//            dd($_FILES['photo']);
            $filePath  = $_FILES['photo']['tmp_name'];

            $image = getimagesize($filePath);
            $name = $this->randomString();
            $extension = image_type_to_extension($image[2]);

            $this->imageName = $name.$extension;
        } else {
            $this->imageName = $_POST['photoName'] ? : "no-photo.jpg";

        }
        return $this->imageName;
    }

    public function validate(){
        $v = new Validator($_POST);
        $v->rules($this->rules);

        if ($v->validate() && $this->validateImage()){
//            dump($v->validate());
            return true;
        } else {
            $this->errors = array_merge($this->errors, $v->errors());
            return false;
        }
    }

    public function validateImage(){
        if (empty($_FILES['photo']['tmp_name'])){
            if (isset($_POST['photoName']) && !empty($_POST['photoName'])){
//            dump("Название картинки есть");
                return true;
            }
        }

        $filePath  = $_FILES['photo']['tmp_name'];
        $errorCode = $_FILES['photo']['error'];

        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
//            dump($errorCode, $filePath);
            // Массив с названиями ошибок
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

            // Выведем название ошибки
            $this->errors['pic'][] = $outputMessage;

            return false;
        }

        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string)finfo_file($fi, $filePath);
        if (strpos($mime, 'image') === false){
            $this->errors['pic'][] = 'Выбр!!!анный файл должен быть картинкой jpeg/jpg/png';
            return false;
        }
        return true;
    }

    public function uploadPhoto(){
        move_uploaded_file($_FILES['photo']['tmp_name'], IMAGES.'/works/'.$this->imageName);
    }

    public static function checkPhoto($works)
    {
        return collect($works)->each(function ($item) {
            if (!file_exists(IMAGES . '/works/' . $item->photoName) || empty($item->photoName)) {
                $item->photoName = 'no-photo.jpg';
            }
        });
    }

    public function getImage()
    {
        if (!file_exists(IMAGES . '/works/' . $this->photoName) || empty($this->photoName)) {
            $this->photoName = 'no-photo.jpg';
        }
        return '/images/works/' . $this->photoName;
    }

    public function getCategoryTitle()
    {
        return Category::where("id", $this->category_id)->firstOrFail()->name;
    }

    public function getStageTitle()
    {
        return Stage::where("id", $this->stage_id)->firstOrFail()->name;
    }

    public function getPublishInfo()
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

    public function getFinishDate()
    {
        $d = date("d", $this->finishDate);
        $m = date("m", $this->finishDate);
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
        $y = date("Y", $this->finishDate);
        return "$d $m<br>$y";
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