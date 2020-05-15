<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\PlaceTable;

class PlaceComponent extends BaseComponent
{
    /** @var PlaceTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($places = $this->table->get("*")) {
            return $places;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($places = $this->table->get("*", ['id' => $id])) {
            return $places[0];
        }
        else {
            return null;
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new PlaceTable();
        }
    }
}