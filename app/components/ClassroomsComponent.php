<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\ClassroomsTable;
use app\model\Classroom;

class ClassroomsComponent extends BaseComponent
{
    /** @var ClassroomsTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($classrooms = $this->table->get("*")) {
            return $classrooms;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($classrooms = $this->table->get("*", ['id' => $id])) {
            return $classrooms[0];
        }
        else {
            return null;
        }
    }

    public function add($number, $seatsNumber)
    {
        $this->setTable();

        $this->table->beginTransaction();

        $classroom = new Classroom($number, $seatsNumber);

        if ($add = $this->table->insert($classroom)) {
            $this->table->commit();
            return true;
        }
        else {
            $this->table->rollBack();
            return "[" . $add[0] . "] " . $add[2];
        }
    }

    public function edit($id, $number, $seatsNumber)
    {
        $this->setTable();

        $this->table->beginTransaction();
        if ($edit = $this->table->update(['number' => $number, 'seats_number' => $seatsNumber], ['id' => $id])) {
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
            $this->table = new ClassroomsTable();
        }
    }
}