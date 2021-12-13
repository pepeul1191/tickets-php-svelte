<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?php echo Flight::get('config')['static_url']; ?>build/bundle.error.css" rel="stylesheet"/>
  <title><?php echo $title ?><</title>
</head>
<body>
  <div class="row text-center">
    <h1 class="align-text-bottom">404</h1>
  </div>
  <div class="row text-center">
    <div class="error-divider">
      <h2>Archivo no encontrado</h2>
      <p class="description">La página que busca no se encuentra en el servidor</p>
    </div>
    <a href="<?php echo Flight::get('config')['base_url']; ?>" class="return-btn"><i class="fa fa-home"></i>Ir al Inicio</a>
  </div>
</body>
</html>