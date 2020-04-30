<?php


namespace app\model;


use base\model\Model;

class Subject extends Model
{
    public $id;
    public $name;
    public $department_id;

    /**
     * Subject constructor.
     * @param $name
     * @param $department_id
     */
    public function __construct($name, $department_id)
    {
        $this->name = $name;
        $this->department_id = $department_id;

        $this->auto_increment = ['id'];
    }
}