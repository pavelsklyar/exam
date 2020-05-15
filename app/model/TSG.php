<?php


namespace app\model;


use base\model\Model;

class TSG extends Model
{
    public $id;
    public $subject_id;
    public $teacher_id;

    /**
     * TSG constructor.
     * @param $subject_id
     * @param $teacher_id
     */
    public function __construct($subject_id, $teacher_id)
    {
        $this->subject_id = $subject_id;
        $this->teacher_id = $teacher_id;

        $this->auto_increment = ['id'];
    }
}