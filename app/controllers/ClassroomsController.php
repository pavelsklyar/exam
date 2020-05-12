<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\ClassroomsComponent;
use base\Page;
use base\View\View;

class ClassroomsController extends BaseController
{
    /** @var ClassroomsComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->setComponent();
    }

    public function index()
    {
        $classrooms = $this->component->getAll();

        new View("site/classrooms/index", $this->page, ['classrooms' => $classrooms]);
    }

    public function item()
    {
        /** TODO: Реализовать */
    }

    public function form()
    {
        if (!empty($this->params)) {
            $data = $this->component->getById($this->params['id']);
            new View("site/classrooms/form", $this->page, ['data' => $data, 'edit' => true]);
        }
        else {
            new View("site/classrooms/form", $this->page);
        }
    }

    public function add()
    {
        $post = $this->page->getPost();

        $number = $post['number'];
        $seatsNumber = $post['seats_number'];

        $add = $this->component->add($number, $seatsNumber);

        if ($add === true) {
            header("Location: /classrooms/");
        }
        else {
            new View("site/classrooms/form", $this->page, ['data' => $post, 'error' => $add]);
        }
    }

    public function edit()
    {
        $post = $this->page->getPost();

        $id = $post['id'];
        $number = $post['number'];
        $seatsNumber = $post['seats_number'];

        $edit = $this->component->edit($id, $number, $seatsNumber);

        if ($edit === true) {
            header("Location: /classrooms/");
        }
        else {
            new View("site/classrooms/form", $this->page, ['data' => $post, 'edit' => true, 'error' => $edit]);
        }
    }

    public function delete()
    {
        $get = $this->page->getGet();
        $id = $get['id'];

        if ($this->component->delete($id)) {
            header("Location: /classrooms/");
        }
    }

    private function setComponent()
    {
        $this->component = new ClassroomsComponent();
    }
}