<?php


namespace app\model;


use base\model\Model;

class Direction extends Model
{
    public $id;
    public $code;
    public $name;
    public $faculty_id;

    /**
     * Direction constructor.
     * @param $code
     * @param $name
     * @param $faculty_id
     */
    public function __construct($code, $name, $faculty_id)
    {
        $this->code = $code;
        $this->name = $name;
        $this->faculty_id = $faculty_id;

        $this->auto_increment = ['id'];
    }


}