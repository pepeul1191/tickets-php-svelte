<?php

require 'vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Flight::before('start', function(&$params, &$output){
  header('x-powered-by: PHP');
  header('Server: Ubuntu');
});
Flight::set('flight.views.path', 'app/views');
Flight::set('env', $_ENV);
Flight::set('config', App\Config\Constants[$_ENV['ENV']]);

$home = function(){
  $locals = array(
    'title' => 'Bienvenido',
  );
  Flight::render('home.php', $locals);
};

Flight::route('GET /', $home);

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
