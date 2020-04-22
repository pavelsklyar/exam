<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\DirectionsComponent;
use app\components\FacultiesComponent;
use base\Page;
use base\View\View;

class DirectionsController extends BaseController
{
    /** @var DirectionsComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->setComponent();
    }

    public function index()
    {
        $directions = $this->component->getAll();

        new View("site/directions/index", $this->page, ['directions' => $directions]);
    }

    public function item()
    {

    }

    public function form()
    {
        $faculties = $this->getFaculties();

        if (!empty($this->params)) {
            $data = $this->component->getById($this->params['id']);
            new View("site/directions/form", $this->page, ['faculties' => $faculties, 'data' => $data, 'edit' => true]);
        }
        else {
            new View("site/directions/form", $this->page, ['faculties' => $faculties]);
        }
    }

    public function add()
    {
        $post = $this->page->getPost();

        $code = $post['code'];
        $name = $post['name'];
        $faculty_id = $post['faculty_id'];

        $add = $this->component->add($code, $name, $faculty_id);

        if ($add === true) {
            header("Location: /directions/");
        }
        else {
            $faculties = $this->getFaculties();
            new View("site/directions/form", $this->page, ['faculties' => $faculties, 'data' => $post, 'error' => $add]);
        }
    }

    public function edit()
    {
        $post = $this->page->getPost();

        $id = $post['id'];
        $code = $post['code'];
        $name = $post['name'];
        $faculty_id = $post['faculty_id'];

        $edit = $this->component->edit($id, $code, $name, $faculty_id);

        if ($edit === true) {
            header("Location: /directions/");
        }
        else {
            $faculties = $this->getFaculties();
            new View("site/directions/form", $this->page, ['faculties' => $faculties, 'data' => $post, 'edit' => true, 'error' => $edit]);
        }
    }

    public function delete()
    {
        $get = $this->page->getGet();
        $id = $get['id'];

        if ($this->component->delete($id)) {
            header("Location: /directions/");
        }
    }

    private function getFaculties()
    {
        $facultiesComponent = new FacultiesComponent();
        return $facultiesComponent->getAll();
    }

    private function setComponent()
    {
        $this->component = new DirectionsComponent();
    }
}