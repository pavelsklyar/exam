<?php


namespace app\model;


use base\model\Model;

class Faculty extends Model
{
    public $id;
    public $name;

    /**
     * Faculty constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;

        $this->auto_increment = ['id'];
    }
}