<?php

function stylesheetsHome($staticURL)
{
  $stylesheets = [];
  switch ($_ENV['FF_ENVIRONMENT']) {
    case 'production': // development
      $stylesheets = [
        $staticURL . 'build/bundle.app',
        $staticURL . 'build/vendor',
        $staticURL . 'assets/css/styles',
      ];
      break;
    case 'development': // production
      $stylesheets = [
        $staticURL . 'build/site.min',
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
    case 'production': // development
      $javascripts = [
        $staticURL . 'build/bundle.app',
        $staticURL . 'build/vendor',
        $staticURL . 'assets/js/site',
      ];
      break;
    case 'development': // production
      $javascripts = [
        $staticURL . 'build/site.min',
      ];
      break;
    default:
      break;
  }
  return $javascripts;
}