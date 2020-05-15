<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\LessonsTable;

class LessonsComponent extends BaseComponent
{
    /** @var LessonsTable */
    protected $table;

    public function getAll()
    {
        $this->setTable();

        if ($lessons = $this->table->get("*")) {

            foreach ($lessons as $key => $lesson) {
                $timeStart = strtotime($lesson['start']);
                $timeEnd = strtotime($lesson['end']);

                $lessons[$key]['start'] = date("H:i", $timeStart);
                $lessons[$key]['end'] = date('H:i', $timeEnd);
            }

            return $lessons;
        }
        else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->setTable();

        if ($lessons = $this->table->get("*", ['id' => $id])) {
            return $lessons[0];
        }
        else {
            return null;
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $this->table = new LessonsTable();
        }
    }
}