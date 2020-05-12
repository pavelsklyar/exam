<?php


namespace app\database;


use base\database\Table;

class GroupsTable extends Table
{
    public function __construct($dbname = "default")
    {
        parent::__construct($dbname);

        $this->tableName = "groups";
    }
}