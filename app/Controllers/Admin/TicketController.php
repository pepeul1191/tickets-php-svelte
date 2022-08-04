<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Filters\SessionTrueApiFilter;
use App\Libraries\RandomLib;

class TicketController extends BaseController
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
    # TODO
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
        $n = \Model::factory('App\\Models\\Ticket', 'app')->create();
        $n->branch_id = $payload['branch_id'];
        $n->description = $payload['description'];
        $n->priority_id = $payload['priority_id'];
        $n->resume = $payload['resume'];
        $n->state_id = $payload['state_id'];
        $n->ticket_type_id = $payload['ticket_type_id'];
        $n->worker_id = $payload['worker_id'];
        $n->created = date("Y-m-d H:i:s");
        $n->edited = date("Y-m-d H:i:s");
        $n->save();
        // response data
        $resp = json_encode([
          'id' => $n->id,
          'edited' => $n->edited,
          'created' => $n->created,
        ]);
      }else{
        $e = \Model::factory('App\\Models\\Ticket', 'app')->find_one($payload['id']);
        $e->branch_id = $payload['branch_id'];
        $e->description = $payload['description'];
        $e->priority_id = $payload['priority_id'];
        $e->resume = $payload['resume'];
        $e->state_id = $payload['state_id'];
        $e->ticket_type_id = $payload['ticket_type_id'];
        $e->worker_id = $payload['worker_id'];
        $e->edited = date("Y-m-d H:i:s");
        $e->save();
        $resp = $e->edited;
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
      $pdo = \ORM::get_db('app');
      $query = "
        SELECT 
          T.id, T.created, T.edited, T.resume, T.description, 
          T.priority_id, T.state_id, T.ticket_type_id, 
          T.branch_id, TT.id AS branch_type_id, 
          T.worker_id, CONCAT(W.last_names, ', ',W.names) AS worker_name
        FROM tickets T 
        JOIN ticket_types TT ON TT.id = T.ticket_type_id 
        JOIN workers W ON W.id = T.worker_id 
        WHERE T.id = %d;";
      $rs = '';
      foreach($pdo->query(sprintf($query, $id)) as $r) {
        $rs = array(
          'id' => $r['id'],
          'branch_id' => $r['branch_id'],
          'description' => $r['description'],
          'priority_id' => $r['priority_id'],
          'branch_type_id' => $r['branch_type_id'],
          'resume' => $r['resume'],
          'state_id' => $r['state_id'],
          'ticket_type_id' => $r['ticket_type_id'],
          'worker_id' => $r['worker_id'],
          'created' => $r['created'],
          'edited' => $r['edited'],
        );
      }
      if($rs == false){
        $resp = 'No existe el ticket a editar';
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
}

?>