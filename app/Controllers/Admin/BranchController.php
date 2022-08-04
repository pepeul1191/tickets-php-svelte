<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Filters\SessionTrueApiFilter;
use App\Filters\CsrfApiFilter;

class BranchController extends BaseController
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
    $type_name = $f3->get('GET.type_name');
    $type_id = 0;
    if($type_name == 'lima'){
      $type_id = 1;
    }else if($type_name == 'province'){
      $type_id = 2;
    }
    // logic
    try {
      $rs = [];
      if ($type_id == 1 || $type_id == 2){
        $rs = \Model::factory('App\\Models\\Branch', 'app')
          ->where_equal('branch_type_id', $type_id)
          ->find_array();
      }else{
        $rs = \Model::factory('App\\Models\\Branch', 'app')
          ->find_array();
      }
      $resp = json_encode($rs);
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
    $createdIds = [];
    $news = $payload['news'];
		$edits = $payload['edits'];
    $deletes = $payload['deletes'];
    // logic
    \ORM::get_db('app')->beginTransaction();
    try {
      // news
      if(count($news) > 0){
				foreach ($news as &$new) {
				  $n = \Model::factory('App\\Models\\Branch', 'app')->create();
					$n->name = $new['name'];
          $n->address = $new['address'];
          $n->phone = $new['phone'];
          $n->whatsapp = $new['whatsapp'];
					$n->save();
				  $temp = [];
				  $temp['tempId'] = $new['id'];
	        $temp['newId'] = $n->id;
	        array_push($createdIds, array(
            'tmp' => $new['id'],
            'id' => $n->id,
          ));
				}
      }
      // edits
      if(count($edits) > 0){
				foreach ($edits as &$edit) {
          $e = \Model::factory('App\\Models\\Branch', 'app')->find_one($edit['id']);
					$e->name = $edit['name'];
          $e->address = $edit['address'];
          $e->phone = $edit['phone'];
          $e->whatsapp = $edit['whatsapp'];
					$e->save();
        }
      }
      // deletes
      if(count($deletes) > 0){
				foreach ($deletes as &$delete) {
			    $d = \Model::factory('App\\Models\\Branch', 'app')->find_one($delete['id']);
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