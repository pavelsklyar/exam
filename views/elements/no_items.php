<?php
/** @var $page_name */

switch ($page_name) {
    case "faculties":
        $page_name = "Факультетов";
        break;
    case "directions":
        $page_name = "Направлений обучения";
        break;
    case "departments":
        $page_name = "Кафедр";
        break;
    case "subjects":
        $page_name = "Предметов";
        break;
    case "teachers":
        $page_name = "Преподавателей";
        break;
    case "groups":
        $page_name = "Групп";
        break;
    case "classrooms":
        $page_name = "Аудиторий";
        break;
    case "users":
        $page_name = "Пользователей";
        break;
}
?>

<p><?= $page_name ?> пока нет</p>