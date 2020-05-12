<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\DepartmentsComponent;
use app\components\TeachersComponent;
use base\Page;
use base\View\View;

class TeachersController extends BaseController
{
    /** @var TeachersComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->setComponent();
    }

    public function index()
    {
        $teachers = $this->component->getAll();

        new View("site/teachers/index", $this->page, ['teachers' => $teachers]);
    }

    public function item()
    {

    }

    public function form()
    {
        $departments = $this->getDepartments();

        if (!empty($this->params)) {
            $data = $this->component->getById($this->params['id']);
            new View("site/teachers/form", $this->page, ['departments' => $departments, 'data' => $data, 'edit' => true]);
        }
        else {
            new View("site/teachers/form", $this->page, ['departments' => $departments]);
        }
    }

    public function add()
    {
        $post = $this->page->getPost();

        $name = $post['name'];
        $surname = $post['surname'];
        $fathername = $post['fathername'];
        $department_id = $post['department_id'];

        $add = $this->component->add($name, $surname, $fathername, $department_id);

        if ($add === true) {
            header("Location: /teachers/");
        }
        else {
            $departments = $this->getDepartments();
            new View("site/teachers/form", $this->page, ['departments' => $departments, 'data' => $post, 'error' => $add]);
        }
    }

    public function edit()
    {
        $post = $this->page->getPost();

        $id = $post['id'];
        $name = $post['name'];
        $surname = $post['surname'];
        $fathername = $post['fathername'];
        $department_id = $post['department_id'];

        $edit = $this->component->edit($id, $name, $surname, $fathername, $department_id);

        if ($edit === true) {
            header("Location: /teachers/");
        }
        else {
            $departments = $this->getDepartments();
            new View("site/teachers/form", $this->page, ['departments' => $departments, 'data' => $post, 'edit' => true, 'error' => $edit]);
        }
    }

    public function delete()
    {
        $get = $this->page->getGet();
        $id = $get['id'];

        if ($this->component->delete($id)) {
            header("Location: /teachers/");
        }
    }

    private function getDepartments()
    {
        $departmentsComponent = new DepartmentsComponent();
        return $departmentsComponent->getAll();
    }

    private function setComponent()
    {
        $this->component = new TeachersComponent();
    }
}