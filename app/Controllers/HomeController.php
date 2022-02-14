<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Filters\SessionTrueFilter;

class HomeController extends BaseController
{
  function __construct()
  {
    parent::__construct();
  }

  function beforeroute($f3) 
  {
    parent::beforeroute($f3);
  }

  function index($f3) 
  {
    parent::loadHelper('home');
    $f3->mset(array(
      'title' => 'Inicio',
      'href' => '/',
      'stylesheets' => stylesheetsHome($f3->get('staticURL')),
      'javascripts' => javascriptsHome($f3->get('staticURL')),
      'enterpriseData' => enterpriseData(),
    ));
    http_response_code(200);
    echo $this->render('home/index', $locals);
  }
}