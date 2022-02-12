<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Filters\ApiFilter;

class ApiController extends BaseController
{
  function __construct()
  {
    parent::__construct();
    parent::loadHelper('orm');
  }

  function beforeroute($f3) 
  {
    parent::beforeroute($f3);
    ApiFilter::before($f3);
  }

  function serviceList($f3)
  {
    // data
    $resp = [];
    $status = 200;
    // logic
    try {
      $rs = \Model::factory('App\\Models\\Service', 'app')
        ->find_array();
      $resp = json_encode($rs);
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }

  function typesWithProjects($f3)
  {
    // data
    $resp = [];
    $status = 200;
    // logic
    try {
      $rs = \Model::factory('App\\Models\\VWProjectTypeProject', 'app')
        ->select('project_type_id', 'id')
        ->select('project_type_name', 'name')
        ->group_by('project_type_id')
        ->order_by_asc('id')
        ->find_array();
      $resp = json_encode($rs);
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }
}