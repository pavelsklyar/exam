<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\AuthComponent;
use base\App;
use base\Page;
use base\View\View;

class AuthController extends BaseController
{
    /** @var AuthComponent */
    private $component;

    public function __construct(Page &$page, $params)
    {
        parent::__construct($page, $params);

        $this->component = new AuthComponent();
    }

    public function form()
    {
        if (App::$session->user->isAuth()) {
            header("Location: /schedule/");
        }

        new View("site/auth/auth", $this->page);
    }

    public function auth()
    {
        $post = $this->page->getPost();

        $email = $post['email'];
        $password = $post['password'];
        $remember = $post['remember'];

        $auth = $this->component->auth($email, $password, $remember);

        if ($auth) {
            header("Location: /schedule/");
        }
        else {
            $form['fields']['error'] = false;
            $form['messages']['error'] = "Неверный email и/или пароль!";

            $view = new View("site/auth/auth", $this->page, ['form' => $form]);
        }
    }

    public function logout()
    {
        if (App::$session->user->isAuth()) {
            if ($this->component->logout()) {
                header("Location: /");
            }
        }
    }
}