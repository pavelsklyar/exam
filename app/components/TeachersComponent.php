<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\DepartmentsTable;
use app\database\TeachersTable;
use app\model\Teacher;

class TeachersComponent extends BaseComponent
{
    /** @var TeachersTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($teachers = $this->table->get("*")) {

            $departmentsComponent = new DepartmentsComponent();

            foreach ($teachers as $key => $teacher) {
                $department = $departmentsComponent->getById($teacher['department_id']);
                $teachers[$key]['department_name'] = $department['name'];
            }

            return $teachers;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($teachers = $this->table->get("*", ['id' => $id])) {
            return $teachers[0];
        }
        else {
            return null;
        }
    }

    public function getByDepartmentId($department_id)
    {
        $this->setTable();

        if ($teachers = $this->table->get("*", ['department_id' => $department_id])) {
            return $teachers;
        }
        else {
            return null;
        }
    }

    public function add($name, $surname, $fathername, $department_id)
    {
        $this->setTable();
        $departmentsTable = new DepartmentsTable();

        $this->table->beginTransaction();
        if (!empty($departmentsTable->get("*", ['id' => $department_id]))) {

            $teacher = new Teacher($name, $surname, $fathername, $department_id);

            if ($add = $this->table->insert($teacher)) {
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
            return "Указанной кафедры не существует!";
        }
    }

    public function edit($id, $name, $surname, $fathername, $department_id)
    {
        $this->setTable();

        $departmentsTable = new DepartmentsTable();

        $this->table->beginTransaction();
        if (!empty($departmentsTable->get("*", ['id' => $department_id]))) {

            if ($edit = $this->table->update(['name' => $name, 'surname' => $surname, 'fathername' => $fathername, "department_id" => $department_id], ['id' => $id])) {
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
            return "Указанной кафедры не существует!";
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new TeachersTable();
        }
    }
}