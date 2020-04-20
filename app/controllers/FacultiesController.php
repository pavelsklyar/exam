<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\FacultiesComponent;
use base\Page;
use base\View\View;

class FacultiesController extends BaseController
{
    /** @var FacultiesComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->setComponent();
    }

    public function index()
    {
        $faculties = $this->component->getAll();

        new View("site/faculties/index", $this->page, ['faculties' => $faculties]);
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

            new View("site/faculties/form", $this->page, ['data' => $data, 'edit' => true]);
        }
        else {
            new View("site/faculties/form", $this->page);
        }
    }

    public function add()
    {
        $post = $this->page->getPost();

        $name = $post['name'];

        $add = $this->component->add($name);
        if ($add  === true) {
            header("Location: /faculties/");
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
            new View("site/faculties/form", $this->page, ['data' => $post, 'error' => $add, 'edit' => true]);
        }
    }

    public function edit()
    {
        $post = $this->page->getPost();

        $id = $post['id'];
        $name = $post['name'];

        $edit = $this->component->edit($id, $name);
        if ($edit === true) {
            header("Location: /faculties/");
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
            new View("site/faculties/form", $this->page, ['data' => $post, 'error' => $edit]);
        }
    }

    public function delete()
    {
        $get = $this->page->getGet();
        $id = $get['id'];

        if ($this->component->delete($id)) {
            header("Location: /faculties/");
        }
    }

    private function setComponent()
    {
        $this->component = new FacultiesComponent();
    }
}