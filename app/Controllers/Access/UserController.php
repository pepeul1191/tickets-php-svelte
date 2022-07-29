<?php

namespace App\Controllers\Access;

use App\Controllers\BaseController;
use App\Filters\SessionTrueApiFilter;
use App\Filters\SessionAdminApiFilter;
use App\Libraries\RandomLib;

class UserController extends BaseController
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
    SessionAdminApiFilter::before($f3);
    //CsrfApiFilter::before($f3);
  }

  function workerGet($f3)
  {
    // data
    $resp = [];
    $status = 200;
    $worker_id = $f3->get('GET.worker_id');
    // logic
    try {
      $r = \Model::factory('App\\Models\\User', 'app')->where('worker_id', $worker_id)->find_one();
      if($r == false){
        $status = 404;
        $resp = '';
      }else{
        $resp = json_encode(array(
          'id' => $r->{'id'},
          'last_login' => $r->{'last_login'},
          'user' => $r->{'user'},
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

  function workerUpdate($f3)
  {
    // data
    $resp = '';
    $status = 200;
    $payload = json_decode(file_get_contents('php://input'));
    $id = $payload->{'id'};
    $worker_id = $payload->{'worker_id'};
    $password = $payload->{'password'};
    $user = $payload->{'user'};
    // logic
    \ORM::get_db('app')->beginTransaction();
    try {
      if($id == 'E'){
        // validate user and email must be unique in db
        $tmpUser = \Model::factory('App\\Models\\User', 'app')->where('user', $user)->find_one();
        $tmpWorker = \Model::factory('App\\Models\\Worker', 'app')->where('email', $email)->find_one();
        if($tmpUser == false && $tmpWorker == false){
          $n = \Model::factory('App\\Models\\User', 'app')->create();
          $n->worker_id = $worker_id;
          $n->password = $password;
          $n->user = $user;
          $n->activation_key = \App\Libraries\RandomLib::stringNumber(20);
          $n->reset_key = \App\Libraries\RandomLib::stringNumber(20);
          $n->save();
          // response data
          $resp = $n->id;
        }else{
          $status = 501;
          $resp = 'No se puede crear usuario porque el nombre de usuario y/o correo están en uso';
        }
      }else{
        $proceed = true;
        // check new user name is unique except himself
        $tmpUser = \Model::factory('App\\Models\\User', 'app')->where('user', $user)->find_one();
        if($tmpUser != false){
          if($tmpUser->id != $id){
            $proceed = false;
          }
        }
        // check new user email is unique except himself
        if($proceed == true){
          $tmpWorker = \Model::factory('App\\Models\\Worker', 'app')->where('email', $email)->find_one();
          if($tmpWorker != false){
            if($tmpWorker->id != $worker_id){
              $proceed = false;
            }
          }
        }
        // proceed if pass two validations
        if($proceed){
          $e = \Model::factory('App\\Models\\User', 'app')->where('id', $id)->find_one();
          if($password != '1111111111'){
            $e->password = $password;
          }
          $e->user = $user; 
          $e->save();
          $resp = '';
        }else{
          $status = 501;
          $resp = 'No se puede editar usuario porque el nombre de usuario y/o correo están en uso';
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
}