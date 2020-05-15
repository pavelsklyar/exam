<?php


namespace app\model;


use base\model\Model;

class Teacher extends Model
{
    public $id;
    public $name;
    public $surname;
    public $fathername;
    public $full_name;
    public $department_id;

    /**
     * Teacher constructor.
     * @param $name
     * @param $surname
     * @param $fathername
     * @param $department_id
     */
    public function __construct($name, $surname, $fathername, $department_id)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->fathername = $fathername;
        $this->department_id = $department_id;

        $this->full_name = $surname . " " . $name . " " . $fathername;

        $this->auto_increment = ['id'];
    }
}