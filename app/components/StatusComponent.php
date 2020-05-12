<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\StatusTable;

class StatusComponent extends BaseComponent
{
    /** @var StatusTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($status = $this->table->get("*")) {
            return $status;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($status = $this->table->get("*", ['id' => $id])) {
            return $status[0];
        }
        else {
            return null;
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new StatusTable();
        }
    }
}