<?php

namespace app\core\libs;


class ImageManager
{
    use HelpersMethods;

    public $err_upload = [];
    public $imageIsValid = false;

    public $imageName = '';

    public $currentName = '';

    public $filePath = '';
    public $fieldForm;


    public function validateImage($fieldForm)
    {
//        dump($_FILES['photo']);
//        dump(empty($_FILES['photo']['tmp_name']));
//        if (empty($_FILES['photo']['tmp_name'])) {
//            dump(isset($_POST['imageName_old']) && !empty($_POST['imageName_old']));
//            if (isset($_POST['imageName_old']) && !empty($_POST['imageName_old'])) {
//            dump("Название картинки есть");
//                $this->imageName = $_POST['imageName_old'];
//                dump($this->imageName);
//                return true;
//            }
//        }
//dd('stop');
        $this->filePath = $_FILES[$fieldForm]['tmp_name'];
        $errorCode = $_FILES[$fieldForm]['error'];

//        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($this->filePath)) {
        if ($errorCode !== UPLOAD_ERR_OK) {
//            dump($errorCode, $filePath);
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

            $this->err_upload['photo'][] = $outputMessage;

            return false;
        }

        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string)finfo_file($fi, $this->filePath);
        if (strpos($mime, 'image') === false) {
            $this->err_upload['photo'][] = 'Выбр!!!анный файл должен быть картинкой jpeg/jpg/png';
            return false;
        }

        $this->imageIsValid = true;
        return true;
    }

    public function createImageName()
    {
        $image = getimagesize($this->filePath);
        $name = $this->randomString();
        $extension = image_type_to_extension($image[2]);

        $this->imageName = $name . $extension;
    }

    public function downloadImage($fieldForm, $pathSave = '')
    {
        $this->fieldForm = $fieldForm;
        $this->createImageName();

        move_uploaded_file($this->filePath, IMAGES . "/{$pathSave}/" . $this->imageName);
        chmod(IMAGES . "/{$pathSave}/" . $this->imageName, 0755);

        return true;
    }


    public static function checkExistFile($path, $filename)
    {
        return is_file(IMAGES . "/{$path}/" . $filename) ? true : false;
    }

    public function delete($fromPath, $imageName)
    {
//        dump(file_exists(IMAGES . "/{$fromPath}/" . $imageName));
//        dump($imageName !== null);
//        dd(file_exists(IMAGES . "/{$fromPath}/" . $imageName) && $imageName !== null);
        if (file_exists(IMAGES . "/{$fromPath}/" . $imageName) && $imageName !== null) {
            unlink(IMAGES . "/{$fromPath}/" . $imageName);
        }
    }

}