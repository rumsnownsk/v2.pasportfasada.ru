<?php

namespace app\models;

use app\core\libs\ImageManager;
use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class User extends Model
{
    public $image;
    public static $isAuth = false;

    protected $table = 'users';

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

    public $errors = array();

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->image = new ImageManager();
        }

    public static function add($fields){
        $user = new static();
        $fields['password'] = password_hash($fields['password'],PASSWORD_DEFAULT);
        $user->fill($fields);
        $user->save();
    }

    public function edit($fields){
        $this->fill($fields);
        return $this->save();
    }

    public function remove(){
        $this->image->delete('users', $this->avatar);
        $this->delete();
    }

    public function uploadImage($fieldForm)
    {
        if ($this->image->validateImage($fieldForm)) {

            $this->image->delete('users', $this->avatar);
            $this->image->downloadImage($fieldForm, 'users');
            $this->avatar = $this->image->imageName;
            $this->save();
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

    public function validate(){
        $v = new Validator($_POST);
        $v->rules($this->rules);

        $this->checkUnique(['username', 'email']);

        if ($v->validate() && empty($this->errors)){
            return true;
        } else {
            $this->errors = array_merge($v->errors(), $this->errors);
            return false;
        }
    }


    public function getErrors(){
//        dd($_SESSION);

//        dd($this->errors);
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li> $item </li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
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

//    public function login(){
//        $username = !empty(trim($_POST['username'])) ? trim($_POST['username']) : null;
//        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
//
//        if ($username && $password){
//            $user = $this->where('username', $username)->where('password', $password)->first();
//
//
//            if($user){
////                if (!empty($_POST['remember'])){
////                    dd($user->username, $_POST);
////                    setcookie('user', $user->username, 3600*60, '/');
////                }
//
////                $_SESSION['auth'] = $user->attributesToArray();
//                $_SESSION['auth'] = $user;
//
////                dd($_SESSION);
//                return true;
//            };
//            $this->errors[]['auth'] = 'Логин/пароль введены не верно';
//            return false;
//        }
//        $this->errors[]['auth'] = 'Необходимо ввести логин и пароль';
//        return false;
//    }

    public function login_old($isAdmin = false){
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if ($login && $password){

            if ($isAdmin){
                $user = R::findOne('user', "login = ? AND role = 'admin' LIMIT 1", [$login]);
            } else {
                $user = R::findOne('user', 'login = ? LIMIT 1', [$login]);
            }

            if ($user){
                if (password_verify($password, $user->password)){
                    foreach ($user as $k => $v) {
                        if ($k !== 'password'){
                            $_SESSION['user'][$k] = $v;
                        }
                    }

                    return true;
                }
            }
        }
        return false;
    }


}