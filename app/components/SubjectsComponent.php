<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\DepartmentsTable;
use app\database\SubjectsTable;
use app\model\Subject;

class SubjectsComponent extends BaseComponent
{
    /** @var SubjectsTable */
    private $table;

    public function getAll()
    {
        $this->setTable();

        if ($subjects = $this->table->get("*")) {

            $departmentsComponent = new DepartmentsComponent();

            foreach ($subjects as $key => $subject) {
                $department = $departmentsComponent->getById($subject['department_id']);
                $subjects[$key]['department_name'] = $department['name'];
            }

            return $subjects;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($subject = $this->table->get("*", ['id' => $id])) {
            return $subject[0];
        }
        else {
            return null;
        }
    }

    public function getByDepartmentId($department_id)
    {
        $this->setTable();

        if ($subjects = $this->table->get("*", ['department_id' => $department_id])) {
            return $subjects;
        }
        else {
            return null;
        }
    }

    public function add($name, $department_id)
    {
        $this->setTable();
        $departmentsTable = new DepartmentsTable();

        $this->table->beginTransaction();
        if (!empty($departmentsTable->get("*", ['id' => $department_id]))) {

            $subject = new Subject($name, $department_id);

            if ($add = $this->table->insert($subject)) {
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

    public function edit($id, $name, $department_id)
    {
        $this->setTable();

        $departmentsTable = new DepartmentsTable();

        $this->table->beginTransaction();
        if (!empty($departmentsTable->get("*", ['id' => $department_id]))) {

            if ($edit = $this->table->update(['name' => $name, "department_id" => $department_id], ['id' => $id])) {
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

    public function delete($id)
    {
        $this->setTable();

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

    private function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new SubjectsTable();
        }
    }
}