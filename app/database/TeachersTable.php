<?php


namespace app\database;


use base\database\Table;

class TeachersTable extends Table
{
    public function __construct($dbname = "default")
    {
        parent::__construct($dbname);

        $this->tableName = "teachers";
    }

    public function search($search)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE `full_name` LIKE '%{$search}%'";
        return $this->getQueryArray($sql);
    }

    public function schedule($full_name)
    {
        $sql = "
            select
                exam.id as id,
                groups.number as group_number,
                subjects.name as subject,
                teachers.surname,
                teachers.name,
                teachers.fathername,
                teachers.full_name,
                classrooms.number as classroom,
                place.date,
                lessons.start as time_start,
                lessons.end as time_end,
                types.name as type
            from
                groups
            left join
                groups_tsg on groups.id = groups_tsg.group_id
            left join
                tsg on groups_tsg.tsg_id = tsg.id
            left join
                exam on exam.tsg_id = tsg.id
            left join
                place on place.id = exam.place_id
            left join
                place_time on place_time.place_id = place.id
            left join
                classrooms on classrooms.id = place.classroom_id
            left join
                lessons on lessons.id = place_time.lesson_id
            left join
                types on types.id = exam.type_id
            left join
                subjects on tsg.subject_id = subjects.id
            left join
                teachers on tsg.teacher_id = teachers.id
            where
                teachers.full_name = '{$full_name}'
            order by
                place.date;
        ";

        return $this->getQueryArray($sql);
    }
}