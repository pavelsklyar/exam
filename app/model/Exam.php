<?php


namespace app\model;


use base\model\Model;

class Exam extends Model
{
    public $id;
    public $place_id;
    public $tsg_id;
    public $type_id;

    /**
     * Exam constructor.
     * @param $place_id
     * @param $tsg_id
     * @param $type_id
     */
    public function __construct($place_id, $tsg_id, $type_id)
    {
        $this->place_id = $place_id;
        $this->tsg_id = $tsg_id;
        $this->type_id = $type_id;

        $this->auto_increment = ['id'];
    }
}