<?php


namespace app\database;


use base\database\Table;

class ExamTable extends Table
{
    public function __construct($dbname = "default")
    {
        parent::__construct($dbname);

        $this->tableName = "exam";
    }

    public function getById($id)
    {
        $sql = "
            select
                exam.id as id,
                groups.id as group_id,
                subjects.id as subject_id,
                teachers.id as teacher_id,
                classrooms.id as classroom_id,
                place.date,
                lessons.id as lesson_id,
                types.id as type_id,
                tsg.id as tsg_id,
                place.id as place_id
            from
                exam
            left join
                place on place.id = exam.place_id
            left join
                place_time on place_time.place_id = place.id
            left join
                lessons on lessons.id = place_time.lesson_id
            left join
                classrooms on classrooms.id = place.classroom_id
            left join
                tsg on tsg.id = exam.tsg_id
            left join
                groups_tsg on groups_tsg.tsg_id = exam.tsg_id
            left join
                groups on groups.id = groups_tsg.group_id
            left join
                teachers on teachers.id = tsg.teacher_id
            left join
                subjects on subjects.id = tsg.subject_id
            left join
                types on types.id = exam.type_id
            where
                exam.id = '{$id}'
        ";

        return $this->getQueryArray($sql);
    }

    public function getInfoForDelete($id)
    {
        $sql = "
            select
                exam.id as exam_id,
                place.id as place_id,
                tsg.id as tsg_id
            from
                exam
            left join
                place on place.id = exam.place_id
            left join
                tsg on tsg.id = exam.tsg_id
            where
                exam.id = '{$id}'
        ";

        return $this->getQueryArray($sql);
    }
}