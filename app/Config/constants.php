<?php

if($_ENV['FF_ENVIRONMENT'] == 'production'){
  return array(
    'baseURL' => 'https://antergo.pe/',
    'staticURL' => 'https://antergo.pe/public/',
    'csrfKey' => 'demo_',
    'csrfValue' => '123_',
  );
}else if($_ENV['FF_ENVIRONMENT'] == 'development'){
  return array(
    'baseURL' => 'http://localhost:8080/',
    'staticURL' => 'http://localhost:8080/public/',
    'csrfKey' => '_demo',
    'csrfValue' => '_123',
  );
}
