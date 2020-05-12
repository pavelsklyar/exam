<?php


namespace app\model;


use base\model\Model;

class Classroom extends Model
{
    public $id;
    public $number;
    public $seats_number;

    /**
     * Classroom constructor.
     * @param $number
     * @param $seats_number
     */
    public function __construct($number, $seats_number)
    {
        $this->number = $number;
        $this->seats_number = $seats_number;

        $this->auto_increment = ['id'];
    }
}