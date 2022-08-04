<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Filters\SessionTrueApiFilter;
use App\Filters\CsrfApiFilter;

class ServiceController extends BaseController
{
  function __construct()
  {
    parent::__construct();
    parent::loadHelper('orm');
  }

  function beforeroute($f3) 
  {
    parent::beforeroute($f3);
    SessionTrueApiFilter::before($f3);
    //CsrfApiFilter::before($f3);
  }

  function list($f3)
  {
    // data
    $resp = [];
    $status = 200;
    // logic
    try {
      $stmt = \Model::factory('App\\Models\\VWTicket', 'app')
        ->where_equal('ticket_type_name', 'SERVICIOS');
      // filter user
      if(
        $f3->get('GET.name') != null
      ){
        $stmt = $stmt->where_like('name', '%' . $f3->get('GET.name') . '%');
      }
      // pages with final statement
      $pages = ceil(
        $stmt->count()
        / $f3->get('GET.step')
      );
      // pagination
      if(
        $f3->get('GET.step') != null && 
        $f3->get('GET.page') != null
      ){
        $offset = ($f3->get('GET.page') - 1) * $f3->get('GET.step');
        $stmt = $stmt->offset($offset)->limit($f3->get('GET.step'));
      }
      $rs = $stmt->find_array();
      $resp = json_encode(array(
        'list' => $rs,
        'pages' => $pages,
      ));
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }
}