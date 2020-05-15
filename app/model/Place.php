<?php


namespace app\model;


use base\model\Model;

class Place extends Model
{
    public $id;
    public $date;
    public $classroom_id;

    /**
     * Place constructor.
     * @param $date
     * @param $classroom_id
     */
    public function __construct($date, $classroom_id)
    {
        $this->date = $date;
        $this->classroom_id = $classroom_id;

        $this->auto_increment = ['id'];
    }
}