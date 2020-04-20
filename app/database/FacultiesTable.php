<?php


namespace app\database;


use base\database\Table;

class FacultiesTable extends Table
{
    public function __construct()
    {
        parent::__construct();

        $this->tableName = "faculties";
    }
}