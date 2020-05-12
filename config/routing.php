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
$routing->add('GET', '/faculties/{id}', FacultiesController::class, 'item', true);
$routing->add('GET', '/faculties/add/', FacultiesController::class, 'form', true);
$routing->add('POST', '/faculties/add/', FacultiesController::class, 'add', true);
$routing->add('GET', '/faculties/edit/{id}', FacultiesController::class, 'form', true);
$routing->add('POST', '/faculties/edit/', FacultiesController::class, 'edit', true);
$routing->add('GET', '/faculties/delete/', FacultiesController::class, 'delete', true);

$routing->add('GET', '/directions/', DirectionsController::class, 'index', true);
$routing->add('GET', '/directions/{id}', DirectionsController::class, 'item', true);
$routing->add('GET', '/directions/add/', DirectionsController::class, 'form', true);
$routing->add('POST', '/directions/add/', DirectionsController::class, 'add', true);
$routing->add('GET', '/directions/edit/{id}', DirectionsController::class, 'form', true);
$routing->add('POST', '/directions/edit/', DirectionsController::class, 'edit', true);
$routing->add('GET', '/directions/delete/', DirectionsController::class, 'delete', true);

$routing->add('GET', '/departments/', DepartmentsController::class, 'index', true);
$routing->add('GET', '/departments/{id}', DepartmentsController::class, 'item', true);
$routing->add('GET', '/departments/add/', DepartmentsController::class, 'form', true);
$routing->add('POST', '/departments/add/', DepartmentsController::class, 'add', true);
$routing->add('GET', '/departments/edit/{id}', DepartmentsController::class, 'form', true);
$routing->add('POST', '/departments/edit/', DepartmentsController::class, 'edit', true);
$routing->add('GET', '/departments/delete/', DepartmentsController::class, 'delete', true);

$routing->add('GET', '/subjects/', SubjectsController::class, 'index', true);
$routing->add('GET', '/subjects/{id}', SubjectsController::class, 'item', true);
$routing->add('GET', '/subjects/add/', SubjectsController::class, 'form', true);
$routing->add('POST', '/subjects/add/', SubjectsController::class, 'add', true);
$routing->add('GET', '/subjects/edit/{id}', SubjectsController::class, 'form', true);
$routing->add('POST', '/subjects/edit/', SubjectsController::class, 'edit', true);
$routing->add('GET', '/subjects/delete/', SubjectsController::class, 'delete', true);

$routing->add('GET', '/teachers/', TeachersController::class, 'index', true);
$routing->add('GET', '/teachers/{id}', TeachersController::class, 'item', true);
$routing->add('GET', '/teachers/add/', TeachersController::class, 'form', true);
$routing->add('POST', '/teachers/add/', TeachersController::class, 'add', true);
$routing->add('GET', '/teachers/edit/{id}', TeachersController::class, 'form', true);
$routing->add('POST', '/teachers/edit/', TeachersController::class, 'edit', true);
$routing->add('GET', '/teachers/delete/', TeachersController::class, 'delete', true);

$routing->add('GET', '/groups/', GroupsController::class, 'index', true);
$routing->add('GET', '/groups/{id}', GroupsController::class, 'item', true);
$routing->add('GET', '/groups/add/', GroupsController::class, 'form', true);
$routing->add('POST', '/groups/add/', GroupsController::class, 'add', true);
$routing->add('GET', '/groups/edit/{id}', GroupsController::class, 'form', true);
$routing->add('POST', '/groups/edit/', GroupsController::class, 'edit', true);
$routing->add('GET', '/groups/delete/', GroupsController::class, 'delete', true);

$routing->add('GET', '/classrooms/', ClassroomsController::class, 'index', true);
$routing->add('GET', '/classrooms/{id}', ClassroomsController::class, 'item', true);
$routing->add('GET', '/classrooms/add/', ClassroomsController::class, 'form', true);
$routing->add('POST', '/classrooms/add/', ClassroomsController::class, 'add', true);
$routing->add('GET', '/classrooms/edit/{id}', ClassroomsController::class, 'form', true);
$routing->add('POST', '/classrooms/edit/', ClassroomsController::class, 'edit', true);
$routing->add('GET', '/classrooms/delete/', ClassroomsController::class, 'delete', true);

$routing->add('GET', '/users/', UsersController::class, 'index', true);
$routing->add('GET', '/users/{id}', UsersController::class, 'item', true);
$routing->add('GET', '/users/add/', UsersController::class, 'form', true);
$routing->add('POST', '/users/add/', UsersController::class, 'add', true);
$routing->add('GET', '/users/edit/{id}', UsersController::class, 'form', true);
$routing->add('POST', '/users/edit/', UsersController::class, 'edit', true);
$routing->add('GET', '/users/delete/', UsersController::class, 'delete', true);