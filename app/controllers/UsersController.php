<?php


namespace app\controllers;


use app\base\BaseController;
use base\App;

class UsersController extends BaseController
{
    protected function checkAccess()
    {
        if (App::$session->user->get("status") === "administrator") {
            $this->page->access = true;
        }
        else {
            $this->page->access = false;
        }
    }
}