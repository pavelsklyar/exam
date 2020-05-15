<?php


namespace app\components;


use app\base\BaseComponent;
use app\database\ExamTable;
use app\database\GroupsTable;
use app\database\GroupsTSGTable;
use app\database\PlaceTable;
use app\database\PlaceTimeTable;
use app\database\TeachersTable;
use app\database\TSGTable;
use app\model\Exam;
use app\model\GroupTSG;
use app\model\Place;
use app\model\PlaceTime;
use app\model\TSG;

class ScheduleComponent extends BaseComponent
{
    private $monthList = [
        '01' => "января",
        '02' => "февраля",
        '03' => "марта",
        '04' => "апреля",
        '05' => "мая",
        '06' => "июня",
        '07' => "июля",
        '08' => "августа",
        '09' => "сентября",
        '10' => "октября",
        '11' => "ноября",
        '12' => "декабря",
    ];

    public function getById($id)
    {
        $examTable = new ExamTable();

        if ($exam = $examTable->getById($id)) {
            return $exam[0];
        }
        else {
            return null;
        }
    }

    public function groups($number)
    {
        $groupsTable = new GroupsTable();

        if (!empty($schedule = $groupsTable->schedule($number))) {
            foreach ($schedule as $key => $item) {
                $date = strtotime($item['date']);
                $timeStart = strtotime($item['time_start']);
                $timeEnd = strtotime($item['time_end']);

                $examDate = date("d m Y", $date);
                $examMonth = date('m', $date);
                $schedule[$key]['date'] = str_replace($examMonth, $this->monthList[$examMonth], $examDate);
                $schedule[$key]['time_start'] = date("H:i", $timeStart);
                $schedule[$key]['time_end'] = date('H:i', $timeEnd);
            }

            return $schedule;
        }
        else {
            return null;
        }
    }

    public function teachers($full_name)
    {
        $teachersTable = new TeachersTable();

        if (!empty($schedule = $teachersTable->schedule($full_name))) {
            foreach ($schedule as $key => $item) {
                $date = strtotime($item['date']);
                $timeStart = strtotime($item['time_start']);
                $timeEnd = strtotime($item['time_end']);

                $examDate = date("d m Y", $date);
                $examMonth = date('m', $date);
                $schedule[$key]['date'] = str_replace($examMonth, $this->monthList[$examMonth], $examDate);
                $schedule[$key]['time_start'] = date("H:i", $timeStart);
                $schedule[$key]['time_end'] = date('H:i', $timeEnd);
            }

            return $schedule;
        }
        else {
            return null;
        }
    }

    public function add($group_id, $subject_id, $teacher_id, $classroom_id, $date, $lesson_id, $type_id)
    {
        /**
         * 1. Создаём TSG из subject_id и teacher_id
         * 2. Создаём GROUPS_TSG из TSG и group_id
         * 3. Создаём PLACE из classroom_id и date
         * 4. Создаём PLACE_TIME из PLACE и lesson_id
         * 5. Создаём EXAM из PLACE, TSG и type_id
         */

        $examTable = new ExamTable();
        $examTable->beginTransaction();

        $subjectsComponent = new SubjectsComponent();
        $teachersComponent = new TeachersComponent();
        if (!empty($subject = $subjectsComponent->getById($subject_id)) && !empty($teacher = $teachersComponent->getById($teacher_id))) {
            $tsgTable = new TSGTable();
            $tsg = new TSG($subject_id, $teacher_id);

            if (!is_array($insert = $tsgTable->insert($tsg))) {
                $tsg_id = $tsgTable->getInsertId();
            }
            else {
                $examTable->rollBack();
                return $insert[0] . " " . $insert[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такого предмета или преподавателя не существует!";
        }

        $groupsComponent = new GroupsComponent();
        if (!empty($group = $groupsComponent->getById($group_id))) {
            $groupTsgTable = new GroupsTSGTable();
            $groupTsg = new GroupTSG($tsg_id, $group_id);

            if (is_array($insert = $groupTsgTable->insert($groupTsg))) {
                $examTable->rollBack();
                return $insert[0] . " " . $insert[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такой группы не существует!";
        }

        $classroomComponent = new ClassroomsComponent();
        if (!empty($classroom = $classroomComponent->getById($classroom_id))) {
            $placeTable = new PlaceTable();
            $place = new Place($date, $classroom_id);

            if (!is_array($insert = $placeTable->insert($place))) {
                $place_id = $placeTable->getInsertId();
            }
            else {
                $examTable->rollBack();
                return $insert[0] . " " . $insert[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такой аудитории не существует!";
        }

        $lessonsComponent = new LessonsComponent();
        if (!empty($lesson = $lessonsComponent->getById($lesson_id))) {
            $placeTimeTable = new PlaceTimeTable();
            $placeTime = new PlaceTime($place_id, $lesson_id);

            if (is_array($insert = $placeTimeTable->insert($placeTime))) {
                $examTable->rollBack();
                return $insert[0] . " " . $insert[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такой пары не существует!";
        }

        $exam = new Exam($place_id, $tsg_id, $type_id);
        if (!is_array($insert = $examTable->insert($exam))) {
            $examTable->commit();
            return true;
        }
        else {
            $examTable->rollBack();
            return $insert[0] . " " . $insert[2];
        }
    }

    public function edit($exam_id, $tsg_id, $place_id, $group_id, $subject_id, $teacher_id, $classroom_id, $date, $lesson_id, $type_id)
    {
        /**
         * Обновление аналогично добавлению по порядку
         */

        $examTable = new ExamTable();
        $examTable->beginTransaction();

        $subjectsComponent = new SubjectsComponent();
        $teachersComponent = new TeachersComponent();
        if (!empty($subject = $subjectsComponent->getById($subject_id)) && !empty($teacher = $teachersComponent->getById($teacher_id))) {
            $tsgTable = new TSGTable();

            if (is_array($update = $tsgTable->update(['subject_id' => $subject_id, 'teacher_id' => $teacher_id], ['id' => $tsg_id]))) {
                $examTable->rollBack();
                return $update[0] . " " . $update[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такого предмета или преподавателя не существует!";
        }

        $groupsComponent = new GroupsComponent();
        if (!empty($group = $groupsComponent->getById($group_id))) {
            $groupTsgTable = new GroupsTSGTable();

            if (is_array($update = $groupTsgTable->update(['group_id' => $group_id], ['tsg_id' => $tsg_id]))) {
                $examTable->rollBack();
                return $update[0] . " " . $update[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такой группы не существует!";
        }

        $classroomComponent = new ClassroomsComponent();
        if (!empty($classroom = $classroomComponent->getById($classroom_id))) {
            $placeTable = new PlaceTable();

            if (is_array($update = $placeTable->update(['date' => $date, 'classroom_id' => $classroom_id], ['id' => $place_id]))) {
                $examTable->rollBack();
                return $update[0] . " " . $update[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такой аудитории не существует!";
        }

        $lessonsComponent = new LessonsComponent();
        if (!empty($lesson = $lessonsComponent->getById($lesson_id))) {
            $placeTimeTable = new PlaceTimeTable();

            if (is_array($update = $placeTimeTable->update(['lesson_id' => $lesson_id], ['place_id' => $place_id]))) {
                $examTable->rollBack();
                return $update[0] . " " . $update[2];
            }
        }
        else {
            $examTable->rollBack();
            return "Такой пары не существует!";
        }

        if (!is_array($update = $examTable->update(['type_id' => $type_id], ['id' => $exam_id]))) {
            $examTable->commit();
            return true;
        }
        else {
            $examTable->rollBack();
            return $update[0] . " " . $update[2];
        }
    }

    public function delete($id)
    {
        $examTable = new ExamTable();
        $examTable->beginTransaction();
        $info = $examTable->getInfoForDelete($id);
        
        $place_id = $info[0]['place_id'];
        $tsg_id = $info[0]['tsg_id'];

        if (is_array($delete = $examTable->delete(['id' => $id]))) {
            $examTable->rollBack();
            return $delete[0] . " " . $delete[2];
        }
        
        $placeTimeTable = new PlaceTimeTable();
        if (is_array($delete = $placeTimeTable->delete(['place_id' => $place_id]))) {
            $examTable->rollBack();
            return $delete[0] . " " . $delete[2];
        }
        
        $placeTable = new PlaceTable();
        if (is_array($delete = $placeTable->delete(['id' => $place_id]))) {
            $examTable->rollBack();
            return $delete[0] . " " . $delete[2];
        }

        $tsgTable = new TSGTable();
        if (is_array($delete = $tsgTable->delete(['id' => $tsg_id]))) {
            $examTable->rollBack();
            return $delete[0] . " " . $delete[2];
        }

        $groupsTsgTable = new GroupsTSGTable();
        if (is_array($delete = $groupsTsgTable->delete(['tsg_id' => $tsg_id]))) {
            $examTable->rollBack();
            return $delete[0] . " " . $delete[2];
        }

        $examTable->commit();
        return true;
    }
}