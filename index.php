<?php

require 'vendor/autoload.php';

header('x-powered-by: PHP');
header('Server: Ubuntu');

Flight::set('flight.views.path', 'app/views');

Flight::route('/', function(){
  $locals = array(
    'title' => 'Bienvenido',
  );
  Flight::render('home.php', $locals);
});

Flight::map('notFound', function(){
  echo '404 :=';
});

Flight::start();

?>
