<?php

namespace app\core\base;

use app\core\Db;
use RedBeanPHP\R;
use Valitron\Validator;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected $primaryKey = 'id';
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        $this->pdo = DB::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $key => $value) {
            if (isset($data[$key])) {
                $this->attributes[$key] = $data[$key];
            }
        }
    }

    public function validate($data)
    {
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        } else {
            $this->errors = $v->errors();
            return false;
        }
    }


    public function save($table){
        $tbl = R::dispense($table);
        foreach ($this->attributes as $key=>$value){
            $tbl->$key = $value;
        }
        return R::store($tbl);
    }

    /**
     * @return array
     */
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


    /**
     * метод-обёртка над методом execute класса Db
     * @param $sql
     * @return bool
     */
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    public function findOne($table, $id, $field = '')
    {
        $field = $field ?: $this->primaryKey;
        return R::findOne($table, "$field = ?", [$id]);
//        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
//        return $this->pdo->query($sql, [$id]);
    }

    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    public function findLike($str, $field, $table = '')
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table where $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }

}