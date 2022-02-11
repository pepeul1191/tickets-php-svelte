<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Filters\SessionTrueFilter;

class AdminController extends BaseController
{
  function __construct()
  {
    parent::__construct();
  }

  function beforeroute($f3) 
  {
    parent::beforeroute($f3);
    $path = $f3->get('PATH');
    $method = $f3->get('VERB');
    if($path == '/admin'){
      SessionTrueFilter::before($f3);
    }
  }

  function info($f3) 
  {
    // data
    $resp = json_encode([
      'user' => $_SESSION['user'],
      'name' => $_SESSION['name'],
      'img' => $_SESSION['img'],
    ]);
    $status = 200;
    // resp
    http_response_code($status);
    echo $resp;
  }

  function index($f3) 
  {
    parent::loadHelper('admin');
    $f3->mset(array(
      'title' => 'Administrador de Contenido',
      'href' => '/',
      'stylesheets' => stylesheetsAdmin($f3->get('staticURL')),
      'javascripts' => javascriptsAdmin($f3->get('staticURL')),
    ));
    http_response_code(200);
    echo $this->render('admin/index', $locals);
  }
}