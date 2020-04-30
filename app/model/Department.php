<?php


namespace app\model;


use base\model\Model;

class Department extends Model
{
    public $id;
    public $name;

    /**
     * Department constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;

        $this->auto_increment = ['id'];
    }
}