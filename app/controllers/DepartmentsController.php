<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\DepartmentsComponent;
use base\Page;
use base\View\View;

class DepartmentsController extends BaseController
{
    /** @var DepartmentsComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->setComponent();
    }

    public function index()
    {
        $departments = $this->component->getAll();

        new View("site/departments/index", $this->page, ['departments' => $departments]);
    }

    public function item()
    {
        /** TODO: Реализовать */
    }

    public function form()
    {
        /** Если переданы параметры, то это edit и надо найти данные в базе */
        if (!empty($this->params)) {
            $id = $this->params['id'];
            $data = $this->component->getById($id);

            new View("site/departments/form", $this->page, ['data' => $data, 'edit' => true]);
        }
        else {
            new View("site/departments/form", $this->page);
        }
    }

    public function add()
    {
        $post = $this->page->getPost();

        $name = $post['name'];

        $add = $this->component->add($name);
        if ($add  === true) {
            header("Location: /departments/");
        }
        else {
            if (strpos($add[2], "column")) {
                $columnExplode = explode("for column '", $add[2]);
                $errorMessage = $columnExplode[0];

                if (count($columnExplode) > 1) {
                    $column = explode("'", $columnExplode[1])[0];

                    $add["error"] = [$column => $errorMessage];
                }
            }
            new View("site/departments/form", $this->page, ['data' => $post, 'error' => $add, 'edit' => true]);
        }
    }

    public function edit()
    {
        $post = $this->page->getPost();

        $id = $post['id'];
        $name = $post['name'];

        $edit = $this->component->edit($id, $name);
        if ($edit === true) {
            header("Location: /departments/");
        }
        else {
            if (strpos($edit[2], "column")) {
                $columnExplode = explode("for column '", $edit[2]);
                $errorMessage = $columnExplode[0];

                if (count($columnExplode) > 1) {
                    $column = explode("'", $columnExplode[1])[0];

                    $add["error"] = [$column => $errorMessage];
                }
            }
            new View("site/departments/form", $this->page, ['data' => $post, 'error' => $edit]);
        }
    }

    public function delete()
    {
        $get = $this->page->getGet();
        $id = $get['id'];

        if ($this->component->delete($id)) {
            header("Location: /departments/");
        }
    }

    private function setComponent()
    {
        if (is_null($this->component)) {
            $this->component = new DepartmentsComponent();
        }
    }
}