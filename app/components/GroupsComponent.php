<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\GroupsTable;
use app\model\Group;

class GroupsComponent extends BaseComponent
{
    /** @var GroupsTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($groups = $this->table->get("*")) {
            return $groups;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($groups = $this->table->get("*", ['id' => $id])) {
            return $groups[0];
        }
        else {
            return null;
        }
    }

    public function search($search)
    {
        $this->setTable();

        return $this->table->search($search);
    }

    public function add($number, $studentsNumber)
    {
        $this->setTable();

        $this->table->beginTransaction();

        $teacher = new Group($number, $studentsNumber);

        if ($add = $this->table->insert($teacher)) {
            $this->table->commit();
            return true;
        }
        else {
            $this->table->rollBack();
            return "[" . $add[0] . "] " . $add[2];
        }
    }

    public function edit($id, $number, $studentsNumber)
    {
        $this->setTable();

        $this->table->beginTransaction();
        if ($edit = $this->table->update(['number' => $number, 'students_number' => $studentsNumber], ['id' => $id])) {
            $this->table->commit();
            return true;
        }
        else {
            $this->table->rollBack();
            return "[" . $edit[0] . "] " . $edit[2];
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new GroupsTable();
        }
    }
}