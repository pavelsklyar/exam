<?php


use app\controllers\AuthController;
use app\controllers\ClassroomsController;
use app\controllers\DepartmentsController;
use app\controllers\DirectionsController;
use app\controllers\FacultiesController;
use app\controllers\GroupsController;
use app\controllers\ScheduleController;
use app\controllers\SubjectsController;
use app\controllers\TeachersController;
use app\controllers\UsersController;
use base\routing\Routing;

$routing = new Routing();

$routing->add('GET', '/', AuthController::class, 'form');
$routing->add('POST', '/', AuthController::class, 'auth');
$routing->add('GET', '/forgot/', AuthController::class, 'forgot');

$routing->add('GET', '/schedule/', ScheduleController::class, 'index', true);

$routing->add('GET', '/faculties/', FacultiesController::class, 'index', true);

$routing->add('GET', '/directions/', DirectionsController::class, 'index', true);

$routing->add('GET', '/departments/', DepartmentsController::class, 'index', true);

$routing->add('GET', '/subjects/', SubjectsController::class, 'index', true);

$routing->add('GET', '/teachers/', TeachersController::class, 'index', true);

$routing->add('GET', '/groups/', GroupsController::class, 'index', true);

$routing->add('GET', '/classrooms/', ClassroomsController::class, 'index', true);

$routing->add('GET', '/users/', UsersController::class, 'index', true);