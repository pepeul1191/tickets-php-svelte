<?php 

namespace App\Config;

const Constants = array(
  'local' => array( 
    'base_url' => 'http://localhost:8080/',
    'static_url' => 'http://localhost:8080/public/',
    'env' => 'local',
  ),
  'prod' => array( 
    'base_url' => '/',
    'static_url' => '/public/',
    'env' => 'prod',
  ),
);

?>
