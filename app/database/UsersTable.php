<?php


namespace app\database;


use base\database\Table;

class UsersTable extends Table
{
    public function __construct()
    {
        parent::__construct();

        $this->tableName = "users";
    }
}