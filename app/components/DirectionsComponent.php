<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\DirectionsTable;
use app\database\FacultiesTable;
use app\model\Direction;

class DirectionsComponent extends BaseComponent
{
    /** @var DirectionsTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($directions = $this->table->get("*")) {

            $facultiesComponent = new FacultiesComponent();

            foreach ($directions as $key => $direction) {
                $faculty = $facultiesComponent->getById($direction['faculty_id']);
                $directions[$key]['faculty_name'] = $faculty['name'];
            }

            return $directions;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($direction = $this->table->get("*", ['id' => $id])) {
            return $direction[0];
        }
        else {
            return null;
        }
    }

    public function getByFacultyId($faculty_id)
    {
        $this->setTable();

        if ($directions = $this->table->get("*", ['faculty_id' => $faculty_id])) {
            return $directions;
        }
        else {
            return null;
        }
    }

    public function add($code, $name, $faculty_id)
    {
        $this->setTable();
        $facultiesTable = new FacultiesTable();

        $this->table->beginTransaction();
        if (!empty($facultiesTable->get("*", ['id' => $faculty_id]))) {

            $direction = new Direction($code, $name, $faculty_id);

            if ($add = $this->table->insert($direction)) {
                $this->table->commit();
                return true;
            }
            else {
                $this->table->rollBack();
                return "[" . $add[0] . "] " . $add[2];
            }
        }
        else {
            $this->table->rollBack();
            return "Указанного факультета не существует!";
        }
    }

    public function edit($id, $code, $name, $faculty_id)
    {
        $this->setTable();

        $facultiesTable = new FacultiesTable();

        $this->table->beginTransaction();
        if (!empty($facultiesTable->get("*", ['id' => $faculty_id]))) {

            if ($edit = $this->table->update(['code' => $code, 'name' => $name, "faculty_id" => $faculty_id], ['id' => $id])) {
                $this->table->commit();
                return true;
            }
            else {
                $this->table->rollBack();
                return "[" . $edit[0] . "] " . $edit[2];
            }
        }
        else {
            $this->table->rollBack();
            return "Указанного факультета не существует!";
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new DirectionsTable();
        }
    }
}