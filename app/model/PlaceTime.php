<?php


namespace app\model;


use base\model\Model;

class PlaceTime extends Model
{
    public $place_id;
    public $lesson_id;

    /**
     * PlaceTime constructor.
     * @param $place_id
     * @param $lesson_id
     */
    public function __construct($place_id, $lesson_id)
    {
        $this->place_id = $place_id;
        $this->lesson_id = $lesson_id;
    }
}