<?php

require 'vendor/autoload.php';

Flight::before('start', function(&$params, &$output){
  header('x-powered-by: PHP');
  header('Server: Ubuntu');
});

Flight::set('flight.views.path', 'app/views');

Flight::route('/', function(){
  $locals = array(
    'title' => 'Bienvenido',
  );
  Flight::render('home.php', $locals);
});

Flight::map('notFound', function(){
  $locals = array(
    'title' => 'Recurso no encontrado',
  );
  Flight::response()->status(404);
  $request = Flight::request();
  if($request->method == 'GET'){
    $extensions = ['css', 'js', 'png', 'ttf'];
    $explodedURL = explode('.', $request->url);
    if(!in_array(end($explodedURL), $extensions)){
      Flight::render('404.php', $locals);
    }
  }else{
    echo 'Recurso no encontrado';
  }
});

Flight::start();

?>
