<?php


namespace app\controllers;


use app\base\BaseController;
use base\View\View;

class ScheduleController extends BaseController
{
    public function index()
    {
        new View("site/schedule/index", $this->page);
    }
}