<?php

# api
$f3->route('GET  /api/service/list', '\App\Controllers\Admin\ApiController->serviceList');
$f3->route('GET  /api/project_type/list', '\App\Controllers\Admin\ApiController->typesWithProjects');
$f3->route('GET  /api/service/project', '\App\Controllers\Admin\ApiController->projects');
#### login
$f3->route('GET  /login', '\App\Controllers\LoginController->index');
$f3->route('GET  /login/sign-in', '\App\Controllers\LoginController->index');
$f3->route('GET  /login/reset-password', '\App\Controllers\LoginController->index');
$f3->route('POST /login', '\App\Controllers\LoginController->access');
$f3->route('GET  /log-out', '\App\Controllers\LoginController->logout');
### admin
$f3->route('GET  /user/info', '\App\Controllers\AdminController->info');
$f3->route('GET  /', '\App\Controllers\HomeController->index');
$f3->route('GET  /position', '\App\Controllers\HomeController->index');
$f3->route('GET  /worker', '\App\Controllers\HomeController->index');
$f3->route('GET  /worker/add', '\App\Controllers\HomeController->index');
$f3->route('GET  /worker/edit/@num', '\App\Controllers\HomeController->index');
$f3->route('GET  /service_type', '\App\Controllers\HomeController->index');
$f3->route('GET  /service', '\App\Controllers\HomeController->index');
$f3->route('GET  /service/add', '\App\Controllers\HomeController->index');
$f3->route('GET  /branch/lima', '\App\Controllers\HomeController->index');
$f3->route('GET  /branch/province', '\App\Controllers\HomeController->index');
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
### access - user
$f3->route('GET  /access/user/worker/get', '\App\Controllers\Access\UserController->workerGet');
$f3->route('POST  /access/user/worker/update', '\App\Controllers\Access\UserController->workerUpdate');

### position
$f3->route('GET  /admin/position/list', '\App\Controllers\Admin\PositionController->list');
$f3->route('POST /admin/position/save', '\App\Controllers\Admin\PositionController->save');
### service_type
$f3->route('GET  /admin/service_type/list', '\App\Controllers\Admin\ServiceTypeController->list');
$f3->route('POST /admin/service_type/save', '\App\Controllers\Admin\ServiceTypeController->save');
### branch
$f3->route('GET  /admin/branch/list', '\App\Controllers\Admin\BranchController->list');
$f3->route('POST /admin/branch/save', '\App\Controllers\Admin\BranchController->save');
### worker
$f3->route('GET  /admin/worker/list', '\App\Controllers\Admin\WorkerController->list');
$f3->route('POST /admin/worker/save', '\App\Controllers\Admin\WorkerController->save');
$f3->route('GET  /admin/worker/get', '\App\Controllers\Admin\WorkerController->get');
$f3->route('GET  /admin/worker/branch', '\App\Controllers\Admin\WorkerController->branch');
$f3->route('POST  /admin/worker/branch/save', '\App\Controllers\Admin\WorkerController->branchSave');
$f3->route('POST /admin/worker/detail/save', '\App\Controllers\Admin\WorkerController->saveDetail');
#### rest - file
$f3->route('POST /upload', '\App\Controllers\FileController->upload');
# error handler
$f3->route('GET  /error/access/@code', '\App\Controllers\ErrorController->access');
$f3->set('ONERROR', include_once 'on_error.php');
