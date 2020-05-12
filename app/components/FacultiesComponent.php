<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\FacultiesTable;
use app\model\Faculty;

class FacultiesComponent extends BaseComponent
{
    /**
     * @var FacultiesTable
     */
    protected $table;

    public function getAll()
    {
        $this->checkTable();

        return $this->table->get("*", null, ['id']);
    }

    public function getById($id)
    {
        $this->checkTable();

        if ($faculty = $this->table->get("*", ['id' => $id])) {
            return $faculty[0];
        }
        else {
            return null;
        }
    }

    public function add($name)
    {
        $this->checkTable();

        $faculty = new Faculty($name);

        if ($add = $this->table->insert($faculty)) {
            return true;
        }
        else {
            return $add;
        }
    }

    public function edit($id, $name)
    {
        $this->checkTable();

        if ($edit = $this->table->update(['name' => $name], ['id' => $id])) {
            return true;
        }
        else {
            return $edit;
        }
    }

    protected function checkTable()
    {
        if (is_null($this->table)) {
            $this->table = new FacultiesTable();
        }
    }
}