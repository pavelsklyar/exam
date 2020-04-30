<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\DepartmentsTable;
use app\model\Department;

class DepartmentsComponent extends BaseComponent
{
    /** @var DepartmentsTable */
    private $table;

    public function getAll()
    {
        $this->checkTable();

        return $this->table->get("*");
    }

    public function getById($id)
    {
        $this->checkTable();

        if ($department = $this->table->get("*", ['id' => $id])) {
            return $department[0];
        }
        else {
            return null;
        }
    }

    public function add($name)
    {
        $this->checkTable();

        $department = new Department($name);

        if ($add = $this->table->insert($department)) {
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

    public function delete($id)
    {
        $this->checkTable();

        $this->table->beginTransaction();
        if ($delete = $this->table->delete(['id' => $id])) {
            $this->table->commit();
            return true;
        }
        else {
            $this->table->rollBack();
            return "[" . $delete[0] . "] " . $delete[2];
        }
    }

    private function checkTable()
    {
        if (is_null($this->table)) {
            $this->table = new DepartmentsTable();
        }
    }
}