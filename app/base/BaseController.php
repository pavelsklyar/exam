<?php


namespace app\base;


use app\components\AuthComponent;
use base\controllers\Controller;

class BaseController extends Controller
{
    /**
     *  Проверка токена авторизации в COOKIE.
     *
     *  TODO: Если авторизация в вашем веб-приложении происходит без помощи
     *  TODO: COOKIE, сделайте этот метод пустым.
     */
    protected function checkAuthToken()
    {
        if (isset($_COOKIE['auth_token']) && !empty($_COOKIE['auth_token'])) {
            $component = new AuthComponent();
            $component->setSession($_COOKIE['auth_token']);
        }
    }
}