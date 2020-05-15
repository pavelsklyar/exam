<?php

$database = require __DIR__ . "/database.php";

return [
    /** Название проекта */
    'name' => 'Деканат: Поддеркжа управления сессией',

    /** Относительные ссылки на главную страницу и страницу авторизации */
    'homeUrl' => '/',
    'authUrl' => '/',

    'database' => $database,

    /** Названия файлов стилей из public_html/css/, которые нужно подключить */
    'styles' => [
        'bootstrap.css',
        'bootstrap-grid.css',
        'bootstrap-reboot.css',
        'main.css',
        'fonts.css'
    ],

    /** Названия скриптовых файлов из public_html/js/, которые нужно подключить */
    'scripts' => [
        'bootstrap.js',
        'bootstrap.bundle.js',
        'search.js'
    ],

    /** Ссылка на favicon относительно public_html/ */
    'favicon' => '',

    'errors' => [
        404 => 'errors/404',
        'access' => 'errors/access'
    ],
];