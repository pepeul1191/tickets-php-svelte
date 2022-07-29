<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Filters\SessionTrueApiFilter;
use App\Libraries\RandomLib;

class WorkerController extends BaseController
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
      $stmt = \Model::factory('App\\Models\\Worker', 'app');
      // filter worker
      if(
        $f3->get('GET.name') != null
      ){
        $name = $f3->get('GET.name');
        $stmt = $stmt->where_raw('(names LIKE "%0' . $name . '%") OR (last_names LIKE "%' . $name . '%")');
      }
      if(
        $f3->get('GET.email') != null
      ){
        $stmt = $stmt->where_like('email', '%' . $f3->get('GET.email') . '%');
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

  function saveDetail($f3)
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
        $n = \Model::factory('App\\Models\\Worker', 'app')->create();
        $n->names = $payload['names'];
        $n->last_names = $payload['last_names'];
        $n->phone = $payload['phone'];
        $n->email = $payload['email'];
        $n->position_id = $payload['position_id'];
        $n->save();
        // response data
        $resp = $n->id;
      }else{
        $e = \Model::factory('App\\Models\\Worker', 'app')->find_one($payload['id']);
        $e->names = $payload['names'];
        $e->last_names = $payload['last_names'];
        $e->phone = $payload['phone'];
        $e->email = $payload['email'];
        $e->position_id = $payload['position_id'];
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

  function branch($f3)
  {
    // data
    $resp = [];
    $status = 200;
    $worker_id = $f3->get('GET.worker_id');
    $branch_type_id = $f3->get('GET.branch_type_id');
    // logic
    try {
      $pdo = \ORM::get_db('app');
      $query = '
        SELECT T.id AS id, T.name AS name, (CASE WHEN (P.exist = 1) THEN 1 ELSE 0 END) AS exist FROM
        (
          SELECT id, name, 0 AS exist FROM branches WHERE branch_type_id = %d
        ) T 
        LEFT JOIN 
        (
          SELECT PT.id, PT.name, 1 AS exist FROM 
          branches PT INNER JOIN branches_workers PTP ON
          PT.id = PTP.branch_id
          WHERE PTP.worker_id = %d
        ) P 
        ON P.id = T.id
      ';
      $rs = array();
      foreach($pdo->query(sprintf($query, $branch_type_id, $worker_id)) as $row) {
        array_push($rs, array(
          'id' => $row['id'],
          'name' => $row['name'],
          'exist' => $row['exist'],
        ));
      }
      if($rs == false){
        $resp = 'Trabajador no trabaja en ninguna sede';
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

  function branchSave($f3)
  {
    // data
    $resp = '';
    $status = 200;
    $payload = json_decode(file_get_contents('php://input'));
    $data = $payload->{'data'};
    $worker_id = $payload->{'id'};
    // logic
    \ORM::get_db('app')->beginTransaction();
    try {
      if(count($data) > 0){
				foreach ($data as &$record) {
          $branch_id = $record->{'id'};
          $exist = $record->{'exist'};
          $e = \Model::factory('App\\Models\\BranchWorker', 'app')
            ->where('branch_id', $branch_id)
            ->where('worker_id', $worker_id)
            ->find_one();
          if($exist == 0){
            if($e != false){
              $e->delete();
            }
          }else{
            if($e == false){
              $n = \Model::factory('App\\Models\\BranchWorker', 'app')->create();
              $n->branch_id = $branch_id;
              $n->worker_id = $worker_id;
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
      $r = \Model::factory('App\\Models\\Worker', 'app')->find_one($id);
      if($r == false){
        $status = 404;
        $resp = '';
      }else{
        $resp = json_encode(array(
          'id' => $r->{'id'},
          'names' => $r->{'names'},
          'last_names' => $r->{'last_names'},
          'phone' => $r->{'phone'},
          'email' => $r->{'email'},
          'position_id' => $r->{'position_id'},
        ));
      }
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }
  
  function delete($f3)
  {
    // data
    $resp = [];
    $status = 200;
    $payload = json_decode(file_get_contents('php://input'), true);
    $createdIds = [];
    $deletes = $payload['deletes'];
    // logic
    \ORM::get_db('app')->beginTransaction();
    try {
      // deletes
      if(count($deletes) > 0){
				foreach ($deletes as &$delete) {
          // delete ProjectTypeProject
          $typesProject = \Model::factory('App\\Models\\ProjectTypeProject', 'app')
            ->where('project_id', $delete['id'])
            ->find_many();
          foreach ($typesProject as &$tp) {
            $tp->delete();
          }
          // delete Project
			    $d = \Model::factory('App\\Models\\Project', 'app')->find_one($delete['id']);
			    $d->delete();
				}
      }
      // commit
      \ORM::get_db('app')->commit();
      // response data
      $resp = json_encode($createdIds);
    }catch (\Exception $e) {
      $status = 500;
      $resp = json_encode(['ups', $e->getMessage()]);
    }
    // resp
    http_response_code($status);
    echo $resp;
  }
}