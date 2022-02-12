<?php

# website
$f3->route('GET  /', '\App\Controllers\HomeController->index');
$f3->route('GET  /contacto', '\App\Controllers\HomeController->index');
$f3->route('POST /mail', '\App\Controllers\MailController->mail');
# api
$f3->route('GET  /api/service/list', '\App\Controllers\Admin\ApiController->serviceList');
$f3->route('GET  /api/project_type/list', '\App\Controllers\Admin\ApiController->typesWithProjects');
#### login
$f3->route('GET  /login', '\App\Controllers\LoginController->index');
$f3->route('GET  /login/sign-in', '\App\Controllers\LoginController->index');
$f3->route('GET  /login/reset-password', '\App\Controllers\LoginController->index');
$f3->route('POST /login', '\App\Controllers\LoginController->access');
$f3->route('GET  /log-out', '\App\Controllers\LoginController->logout');
### admin
$f3->route('GET  /user/info', '\App\Controllers\AdminController->info');
$f3->route('GET  /admin', '\App\Controllers\AdminController->index');
$f3->route('GET  /admin/project-type', '\App\Controllers\AdminController->index');
$f3->route('GET  /admin/service', '\App\Controllers\AdminController->index');
$f3->route('GET  /admin/project', '\App\Controllers\AdminController->index');
$f3->route('GET  /admin/project/add', '\App\Controllers\AdminController->index');
$f3->route('GET  /admin/project/edit/@num', '\App\Controllers\AdminController->index');
### admin - project-type
$f3->route('GET  /admin/project-type/list', '\App\Controllers\Admin\ProjectTypeController->list');
$f3->route('POST /admin/project-type/save', '\App\Controllers\Admin\ProjectTypeController->save');
### admin - service
$f3->route('GET  /admin/service/list', '\App\Controllers\Admin\ServiceController->list');
$f3->route('POST /admin/service/save', '\App\Controllers\Admin\ServiceController->save');
### admin - project
$f3->route('GET  /admin/project/list', '\App\Controllers\Admin\ProjectController->list');
$f3->route('GET  /admin/project/project-type', '\App\Controllers\Admin\ProjectController->projectType');
$f3->route('POST /admin/project/detail/save', '\App\Controllers\Admin\ProjectController->save');
$f3->route('POST /admin/project/delete', '\App\Controllers\Admin\ProjectController->delete');
$f3->route('POST /admin/project/type/save', '\App\Controllers\Admin\ProjectController->projectTypeSave');
$f3->route('GET  /admin/project/get', '\App\Controllers\Admin\ProjectController->get');
### admin - project_image
$f3->route('GET  /admin/project/image/list', '\App\Controllers\Admin\ProjectImageController->list');
$f3->route('POST /admin/project/image/save', '\App\Controllers\Admin\ProjectImageController->save');
#### rest - file
$f3->route('POST /upload', '\App\Controllers\FileController->upload');
# error handler
$f3->route('GET  /error/access/@code', '\App\Controllers\ErrorController->access');
$f3->set('ONERROR', include_once 'on_error.php');
