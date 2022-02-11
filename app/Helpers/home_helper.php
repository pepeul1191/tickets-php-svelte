<?php

function stylesheetsHome($staticURL)
{
  $stylesheets = [];
  switch ($_ENV['FF_ENVIRONMENT']) {
    case 'development':
      $stylesheets = [
        $staticURL . 'build/bundle.app',
        $staticURL . 'build/vendor.min',
        $staticURL . 'assets/css/styles',
      ];
      break;
    case 'production':
      $stylesheets = [
        $staticURL . 'build/bundle.app',
        $staticURL . 'assets/css/styles',
      ];
      break;
    default:
      break;
  }
  return $stylesheets;
}

function javascriptsHome($staticURL)
{
  $javascripts = [];
  switch ($_ENV['FF_ENVIRONMENT']) {
    case 'development':
      $javascripts = [
        $staticURL . 'build/bundle.app',
        $staticURL . 'build/vendor.min',
        $staticURL . 'assets/js/site',
      ];
      break;
    case 'production':
      $javascripts = [
        $staticURL . 'build/bundle.app.min',
        $staticURL . 'build/vendor.min',
        $staticURL . 'assets/js/site',
      ];
      break;
    default:
      break;
  }
  return $javascripts;
}