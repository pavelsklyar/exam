<?php


namespace app\model;


use base\model\Model;

class Status extends Model
{
    public $id;
    public $name;

    /**
     * Status constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;

        $this->auto_increment = ['id'];
    }
}