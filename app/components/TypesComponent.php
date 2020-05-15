<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\TypesTable;

class TypesComponent extends BaseComponent
{
    /** @var TypesTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($lessons = $this->table->get("*", null, ['id'])) {
            return $lessons;
        }
        else {
            return null;
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new TypesTable();
        }
    }
}