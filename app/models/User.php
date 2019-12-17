<?php

namespace app\models;

use app\core\libs\HelpersMethods;
use app\core\libs\ImgLoader;
use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class User extends Model
{
    use HelpersMethods;

    public static $isAuth = false;


    protected $dateFormat = 'U';

    public $fillable = [
        "username",
        "password" ,
        "role",
        "email",
        "fio",
        "phone",
    ];

    protected $hidden = [
        'password',
        'password_cookie_token',
    ];

    public $rules = [
        'required' => [
            ['username'],
            ['password'],
            ['role'],
        ],
        'lengthMin' => [
            ['password', 5]
        ]
    ];

    protected $table = 'users';

    public $errors = array();
    public $imgLoader;

    public function __construct()
    {
        parent::__construct();
        $this->imgLoader = new ImgLoader();
    }

    public static function add($fields){

        $user = new static();
        $fields['password'] = password_hash($fields['password'],PASSWORD_DEFAULT);
        $user->fill($fields);
        $user->save();
        return $user;
    }

    public function edit($fields){
        if ($fields['password']){
            $fields['password'] = password_hash($fields['password'],PASSWORD_DEFAULT);
        } else {
            $fields['password'] = $this->getAttribute('password');
        }
        $this->fill($fields);
        return $this->save();
    }

    public function remove(){
        $this->imgLoader->delete('users', $this->avatar);
        $this->delete();
    }

    public function loadImage()
    {
        if ($this->imgLoader->validateImage('avatar')) {

            $this->imgLoader->delete('users', $this->avatar);

            $this->avatar = $this->imgLoader->uploadImage($_FILES['avatar'], 'users');

            $this->save();
            return true;

        } else {
            $this->errors = array_merge($this->errors, $this->imgLoader->errors);
            return false;
        }
    }

    public function getImage(){
        if (!file_exists(IMAGES . '/users/' . $this->avatar) || empty($this->avatar)) {
            return '/images/no_avatar.png';
        }
        return '/images/users/' . $this->avatar;
    }

    public function getRole(){
        switch ($this->role) {
            case '0' : return 'создатель'; break;
            case '1' : return 'директор'; break;
            case '2' : return 'работник'; break;
            default: return null;
        }
    }

    public function validate(array $exceptFields = []){
        $v = new Validator($_POST);

        if (!empty($exceptFields)){
            foreach ($exceptFields as $field){

                for ($i = 0; $i < count($this->rules['required']); $i++){

                    if ($this->rules['required'][$i][0] == $field){
                        unset($this->rules['required'][$i]);
                    }
                }
            }
        }

        $v->rules($this->rules);

        $this->checkUnique(['username', 'email']);

        if ($v->validate() && empty($this->errors)){
            if (isset($_SESSION['oldData'])) {
                unset($_SESSION['oldData']);
            };
            return true;
        } else {
            $this->errors = array_merge($v->errors(), $this->errors);
            return false;
        }
    }

    public function checkUnique(array $fields){
        foreach ($fields as $field) {
            if (!empty($_POST[$field])) {
                $user = User::where($field, $_POST[$field])->first();

                if ($user && $user->id !== $this->id){
                    $this->errors['unique'][] = $user->$field . ' - занято';
                }
            }
        }

//        dd('non');
//        if ($user) {
//            if ($user->login == $this->attributes['login']){
//            }
//            if ($user->email == $this->attributes['email']){
//                $this->errors['unique'][] = 'Этот email занят';
//            }
//            return false;
//        }
//        return true;
    }


}