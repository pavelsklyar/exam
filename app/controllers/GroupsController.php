<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\DirectionsComponent;
use app\components\GroupsComponent;
use base\Page;
use base\View\View;

class GroupsController extends BaseController
{
    /** @var GroupsComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->setComponent();
    }

    public function index()
    {
        $groups = $this->component->getAll();

        new View("site/groups/index", $this->page, ['groups' => $groups]);
    }

    public function item()
    {
        /** TODO: Реализовать */
    }

    public function form()
    {
        if (!empty($this->params)) {
            $data = $this->component->getById($this->params['id']);
            new View("site/groups/form", $this->page, ['data' => $data, 'edit' => true]);
        }
        else {
            new View("site/groups/form", $this->page);
        }
    }

    public function add()
    {
        $post = $this->page->getPost();

        $number = $post['number'];
        $studentsNumber = $post['students_number'];

        $add = $this->component->add($number, $studentsNumber);

        if ($add === true) {
            header("Location: /groups/");
        }
        else {
            new View("site/groups/form", $this->page, ['data' => $post, 'error' => $add]);
        }
    }

    public function edit()
    {
        $post = $this->page->getPost();

        $id = $post['id'];
        $number = $post['number'];
        $studentsNumber = $post['students_number'];

        $edit = $this->component->edit($id, $number, $studentsNumber);

        if ($edit === true) {
            header("Location: /groups/");
        }
        else {
            new View("site/groups/form", $this->page, ['data' => $post, 'edit' => true, 'error' => $edit]);
        }
    }

    public function delete()
    {
        $get = $this->page->getGet();
        $id = $get['id'];

        if ($this->component->delete($id)) {
            header("Location: /groups/");
        }
    }

    private function setComponent()
    {
        $this->component = new GroupsComponent();
    }
}