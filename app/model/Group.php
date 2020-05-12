<?php


namespace app\model;


use base\model\Model;

class Group extends Model
{
    public $id;
    public $number;
    public $students_number;

    /**
     * Group constructor.
     * @param $number
     * @param $students_number
     */
    public function __construct($number, $students_number)
    {
        $this->number = $number;
        $this->students_number = $students_number;

        $this->auto_increment = ['id'];
    }
}