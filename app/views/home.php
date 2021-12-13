<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='icon' type='image/png' href='<?php echo Flight::get('config')['static_url']; ?>/favicon.png'>
  <?php if(Flight::get('config')['env'] == 'local'){ ?>
    <link href="<?php echo Flight::get('config')['static_url']; ?>build/bundle.app.css" rel="stylesheet"/>
  <?php } ?>
  <?php if(Flight::get('config')['env'] == 'prod'){ ?>
    <link href="<?php echo Flight::get('config')['static_url']; ?>build/bundle.app.min.css" rel="stylesheet"/>
  <?php } ?>
  <title><?php echo $title ?></title>
  <script>
    const BASE_URL = '<?php echo Flight::get('config')['base_url']; ?>';
    const STATIC_URL = '<?php echo Flight::get('config')['static_url']; ?>';
  </script>
</head>
<body>
  <?php if(Flight::get('config')['env'] == 'local'){ ?>
    <script src="<?php echo Flight::get('config')['static_url']; ?>build/bundle.app.js"type="text/javascript"></script>
  <?php } ?>
  <?php if(Flight::get('config')['env'] == 'prod'){ ?>
    <script src="<?php echo Flight::get('config')['static_url']; ?>build/bundle.app.min.js"type="text/javascript"></script>
  <?php } ?>
</body>
</html>