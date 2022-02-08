<?php

# website
$f3->route('GET /', '\App\Controllers\HomeController->index');
$f3->route('POST /mail', '\App\Controllers\MailController->mail');
#### login
$f3->route('GET /login', '\App\Controllers\LoginController->index');
$f3->route('GET /login/sign-in', '\App\Controllers\LoginController->index');
$f3->route('GET /login/reset-password', '\App\Controllers\LoginController->index');
$f3->route('POST /login', '\App\Controllers\LoginController->access');
$f3->route('GET /log-out', '\App\Controllers\LoginController->logout');
# error handler
$f3->route('GET /error/access/@code', '\App\Controllers\ErrorController->access');
$f3->set('ONERROR', include_once 'on_error.php');
