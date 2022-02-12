<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Filters\SessionTrueApiFilter;
use App\Libraries\RandomLib;

class ProjectController extends BaseController
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
      $stmt = \Model::factory('App\\Models\\Project', 'app')
        ->select('id')
        ->select('date')
        ->select('name');
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

  function save($f3)
  {
    // data
    $resp = [];
    $status = 200;
    $payload = json_decode(file_get_contents('php://input'), true);
    $createdId = [];
    // logic
    \ORM::get_db('app')->beginTransaction();
    try {
      if($payload['id'] == 'E'){
        $n = \Model::factory('App\\Models\\Project', 'app')->create();
        $n->date = $payload['date'];
        $n->name = $payload['name'];
        $n->description = $payload['description'];
        $n->url = $payload['url'];
        $n->save();
        // response data
        $resp = $n->id;
      }else{
        $e = \Model::factory('App\\Models\\Project', 'app')->find_one($payload['id']);
        $e->date = $payload['date'];
        $e->name = $payload['name'];
        $e->description = $payload['description'];
        $e->url = $payload['url'];
        $e->save();
        $resp = '';
      }
      // commit
      \ORM::get_db('app')->commit();
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }

  function projectType($f3)
  {
    // data
    $resp = [];
    $status = 200;
    $project_id = $f3->get('GET.id');
    // logic
    try {
      $pdo = \ORM::get_db('app');
      $query = '
        SELECT T.id AS id, T.name AS name, (CASE WHEN (P.exist = 1) THEN 1 ELSE 0 END) AS exist FROM
        (
          SELECT id, name, 0 AS exist FROM project_types
        ) T 
        LEFT JOIN 
        (
          SELECT PT.id, PT.name, 1 AS exist FROM 
          project_types PT INNER JOIN project_types_projects PTP ON
          PT.id = PTP.project_type_id
          WHERE PTP.project_id = %d
        ) P 
        ON P.id = T.id
      ';
      $rs = array();
      foreach($pdo->query(sprintf($query, $project_id)) as $row) {
        array_push($rs, array(
          'id' => $row['id'],
          'name' => $row['name'],
          'exist' => $row['exist'],
        ));
      }
      if($rs == false){
        $resp = 'Parcipante no tiene tipos de proyecto asociado';
        $status = 404;
      }else{
        $resp = json_encode($rs);
      }
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }

  function projectTypeSave($f3)
  {
    // data
    $resp = '';
    $status = 200;
    $payload = json_decode(file_get_contents('php://input'));
    $data = $payload->{'data'};
    $project_id = $payload->{'id'};
    // logic
    \ORM::get_db('app')->beginTransaction();
    try {
      if(count($data) > 0){
				foreach ($data as &$record) {
          $project_type_id = $record->{'id'};
          $exist = $record->{'exist'};
          $e = \Model::factory('App\\Models\\ProjectTypeProject', 'app')
            ->where('project_type_id', $project_type_id)
            ->where('project_id', $project_id)
            ->find_one();
          if($exist == 0){
            if($e != false){
              $e->delete();
            }
          }else{
            if($e == false){
              $n = \Model::factory('App\\Models\\ProjectTypeProject', 'app')->create();
              $n->project_type_id = $project_type_id;
              $n->project_id = $project_id;
              $n->save();
            }
          }
        }
      }
      // commit
      \ORM::get_db('app')->commit();
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }

  function get($f3)
  {
    // data
    $resp = [];
    $status = 200;
    $id = $f3->get('GET.id');
    // logic
    try {
      $r = \Model::factory('App\\Models\\Project', 'app')->find_one($id);
      $resp = json_encode(array(
        'id' => $r->{'id'},
        'name' => $r->{'name'},
        'description' => $r->{'description'},
        'date' => $r->{'date'},
        'url' => $r->{'url'},
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