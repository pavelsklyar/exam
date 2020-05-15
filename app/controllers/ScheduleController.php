<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\ClassroomsComponent;
use app\components\GroupsComponent;
use app\components\LessonsComponent;
use app\components\ScheduleComponent;
use app\components\SubjectsComponent;
use app\components\TeachersComponent;
use app\components\TypesComponent;
use base\Page;
use base\View\View;

class ScheduleController extends BaseController
{
    /** @var ScheduleComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->component = new ScheduleComponent();
    }

    public function index()
    {
        new View("site/schedule/index", $this->page);
    }

    public function groupsSearch()
    {
        $this->page->api = true;

        $post = $this->page->getPost();
        $search = $post['search'];

        $component = new GroupsComponent();
        if ($result = $component->search($search)) {
            echo "<div class='search_result'><table>";
            foreach ($result as $row) {
                $item = $row['number'];

                $bold = "<b>" . $search . "</b>";
                $boldVerb = str_replace($search, $bold, $item);

                echo "
                <tr>
                    <td class='search_result-name'>
                        <a class='verbs' href='#' onclick='enter(\"$item\")'>$boldVerb</a>
                    </td>
                </tr>
                ";
            }
            echo "</table></div>";
        }
    }

    public function teachersSearch()
    {
        $this->page->api = true;

        $post = $this->page->getPost();
        $search = $post['search'];

        $component = new TeachersComponent();
        if ($result = $component->search($search)) {
            echo "<div class='search_result'><table>";
            foreach ($result as $row) {
                $item = $row['full_name'];

                $bold = "<b>" . $search . "</b>";
                $boldVerb = str_replace($search, $bold, $item);

                echo "
                <tr>
                    <td class='search_result-name'>
                        <a class='verbs' href='#' onclick='enter(\"$item\")'>$boldVerb</a>
                    </td>
                </tr>
                ";
            }
            echo "</table></div>";
        }
    }

    public function groups()
    {
        $component = new GroupsComponent();
        $groups = $component->getAll();

        new View("site/schedule/index", $this->page, ['type' => "groups"]);
    }

    public function groupsSchedule()
    {
        $post = $this->page->getPost();
        $number = $post['search'];

        $schedule = $this->component->groups($number);
        new View("site/schedule/schedule", $this->page, ['type' => "groups", 'schedule' => $schedule]);
    }

    public function teachers()
    {
        new View("site/schedule/index", $this->page, ['type' => 'teachers']);
    }

    public function teachersSchedule()
    {
        $post = $this->page->getPost();
        $name = $post['search'];

        $schedule = $this->component->teachers($name);
        new View("site/schedule/schedule", $this->page, ['type' => "teachers", 'schedule' => $schedule]);
    }

    public function form()
    {
        $groupsComponent = new GroupsComponent();
        $groups = $groupsComponent->getAll();

        $subjectsComponent = new SubjectsComponent();
        $subjects = $subjectsComponent->getAll();

        $teachersComponent = new TeachersComponent();
        $teachers = $teachersComponent->getAll();

        $classroomsComponent = new ClassroomsComponent();
        $classrooms = $classroomsComponent->getAll();

        $lessonsComponent = new LessonsComponent();
        $lessons = $lessonsComponent->getAll();

        $typesComponent = new TypesComponent();
        $types = $typesComponent->getAll();

        if (!empty($this->params)) {
            $data = $this->component->getById($this->params['id']);

            new View("site/schedule/form", $this->page, [
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'classrooms' => $classrooms,
                'lessons' => $lessons,
                'types' => $types,
                'edit' => true,
                'data' => $data
            ]);
        }
        else {
            new View("site/schedule/form", $this->page, [
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'classrooms' => $classrooms,
                'lessons' => $lessons,
                'types' => $types
            ]);
        }
    }

    public function add()
    {
        $post = $this->page->getPost();

        $group_id = $post['group_id'];
        $subject_id = $post['subject_id'];
        $teacher_id = $post['teacher_id'];
        $classroom_id = $post['classroom_id'];
        $date = $post['date'];
        $lesson_id = $post['lesson_id'];
        $type_id = $post['type_id'];

        if (($add = $this->component->add($group_id, $subject_id, $teacher_id, $classroom_id, $date, $lesson_id, $type_id)) === true) {
            header("Location: /schedule/");
        }
        else {
            $groupsComponent = new GroupsComponent();
            $groups = $groupsComponent->getAll();

            $subjectsComponent = new SubjectsComponent();
            $subjects = $subjectsComponent->getAll();

            $teachersComponent = new TeachersComponent();
            $teachers = $teachersComponent->getAll();

            $classroomsComponent = new ClassroomsComponent();
            $classrooms = $classroomsComponent->getAll();

            $lessonsComponent = new LessonsComponent();
            $lessons = $lessonsComponent->getAll();

            $typesComponent = new TypesComponent();
            $types = $typesComponent->getAll();

            new View("site/schedule/form", $this->page, [
                'data' => $post,
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'classrooms' => $classrooms,
                'lessons' => $lessons,
                'types' => $types,
                'error' => $add
            ]);
        }
    }

    public function edit()
    {
        $post = $this->page->getPost();

        $id = $post['id'];
        $tsg_id = $post['tsg_id'];
        $place_id = $post['place_id'];

        $group_id = $post['group_id'];
        $subject_id = $post['subject_id'];
        $teacher_id = $post['teacher_id'];
        $classroom_id = $post['classroom_id'];
        $date = $post['date'];
        $lesson_id = $post['lesson_id'];
        $type_id = $post['type_id'];

        if (($edit = $this->component->edit($id, $tsg_id, $place_id, $group_id, $subject_id, $teacher_id, $classroom_id, $date, $lesson_id, $type_id)) === true) {
            header("Location: /schedule/");
        }
    }

    public function delete()
    {
        $get = $this->page->getGet();
        $id = $get['id'];

        if (($delete = $this->component->delete($id)) === true) {
            header("Location: /schedule/");
        }
        else {
            new View("errors/delete", $this->page, ['error' => $delete]);
        }
    }
}