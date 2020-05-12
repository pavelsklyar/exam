<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\UsersTable;

class UsersComponent extends BaseComponent
{
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($users = $this->table->get("*")) {

            $statusComponent = new StatusComponent();
            foreach ($users as $key => $user) {
                $status = $statusComponent->getById($user['status_id']);
                $users[$key]['status'] = $status['runame'];
            }

            return $users;
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
            $this->table = new UsersTable();
        }
    }
}