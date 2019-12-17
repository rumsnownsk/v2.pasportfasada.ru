<?php

namespace app\core\libs;


use Intervention\Image\ImageManagerStatic as Image;

class ImgLoader
{
    use HelpersMethods;

    public $errors = [];

    public function __construct()
    {
        Image::configure(array('driver' => 'imagick'));
    }

    public function validateImage($fieldForm){

        $errorCode = $_FILES[$fieldForm]['error'];

        if ($errorCode !== UPLOAD_ERR_OK) {

            // Массив с названиями ошибок
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
            ];
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

            // Выведем название ошибки

            $this->errors['image'][] = $outputMessage;

            return false;
        }

        // проверка mime-типа файла
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string)finfo_file($finfo, $_FILES[$fieldForm]['tmp_name']);

        $allowedMimeTypes = [
            'image/gif',
            'image/jpeg',
            'image/jpg',
            'image/png'
        ];

        if (in_array($mime, $allowedMimeTypes) == false) {
            $this->errors['image'][] = 'Выбранный файл должен быть картинкой jpeg/jpg/png';
            return false;
        }

        return true;
    }

    public function uploadImage($image, $dirToSave){

        $filename = $this->randomString() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);

        Image::make($image['tmp_name'])->save(IMAGES."/{$dirToSave}/".$filename);

        return $filename;
    }

    public function delete($fromPath, $imageName)
    {
        if (file_exists(IMAGES . "/{$fromPath}/" . $imageName) && $imageName !== null) {
            unlink(IMAGES . "/{$fromPath}/" . $imageName);
        }
    }
}