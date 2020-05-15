<?php


namespace app\model;


use base\model\Model;

class GroupTSG extends Model
{
    public $tsg_id;
    public $group_id;

    /**
     * GroupTSG constructor.
     * @param $tsg_id
     * @param $group_id
     */
    public function __construct($tsg_id, $group_id)
    {
        $this->tsg_id = $tsg_id;
        $this->group_id = $group_id;
    }
}