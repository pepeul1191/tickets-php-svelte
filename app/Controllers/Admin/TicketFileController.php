<?php

namespace App\Controllers\Admin;

use App\Controllers\FileController;
use App\Filters\SessionTrueApiFilter;
use App\Filters\CsrfApiFilter;

class TicketFileController extends FileController
{
  function __construct()
  {
    parent::__construct();
    parent::loadHelper('orm');
  }

  function beforeroute($f3) 
  {
    parent::beforeroute($f3);
  }

  function upload($f3)
  {
    $ticketId = $f3->get('POST.ticket_id');
    if($ticketId == 'E'){
      $status = 500;
      $resp = 'Debe de generar primero el ticket';
      http_response_code($status);
      echo $resp;
    }else{
      $dirname = UPLOAD_PATH. $f3->get('POST.ticket_type') . '/' . $f3->get('POST.ticket_id');
      if(!file_exists($dirname)){
        mkdir($dirname . '', 0777);
      }
      $dirname = $dirname . '/header';
      if(!file_exists($dirname)){
        mkdir($dirname . '', 0777);
      }
      $this->extraPath = $f3->get('POST.ticket_type') . '/' . $f3->get('POST.ticket_id') . '/header/';
      parent::upload($f3);
    }
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
    $ticket_id = $payload['extra']['ticket_id'];
    // logic
    \ORM::get_db('app')->beginTransaction();
    try {
      // news
      if(count($news) > 0){
				foreach ($news as &$new) {
				  $n = \Model::factory('App\\Models\\TicketFile', 'app')->create();
					$n->description = $new['description'];
          $n->url = $new['url'];
          $n->ticket_id = $ticket_id;
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
          $e = \Model::factory('App\\Models\\TicketFile', 'app')->find_one($edit['id']);
					$e->description = $edit['description'];
          $e->url = $edit['url'];
					$e->save();
        }
      }
      // deletes
      if(count($deletes) > 0){
				foreach ($deletes as &$delete) {
			    $d = \Model::factory('App\\Models\\TicketFile', 'app')->find_one($delete['id']);
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