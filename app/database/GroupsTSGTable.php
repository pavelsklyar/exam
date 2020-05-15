<?php


namespace app\database;


use base\database\Table;

class GroupsTSGTable extends Table
{
    public function __construct($dbname = "default")
    {
        parent::__construct($dbname);

        $this->tableName = "groups_tsg";
    }
}