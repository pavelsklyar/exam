<?php


namespace app\base;


use base\component\Component;

class BaseComponent extends Component
{
    protected $table;

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
}