<?php

include_once "../vendor/autoload.php";
include_once "../app/autoloader.php";

use App\Controllers\BaseController;
use App\Router;
use App\Config;

define('VIEW_PREFIX', '../app/views/');
define('HTML_ASSET_PREFIX', 'assets/');

Config::load();
BaseController::setViews([
    'home' => [
        'view' => VIEW_PREFIX . 'home.php',
        'css' => HTML_ASSET_PREFIX . 'css/app/home.css',
        'js' => HTML_ASSET_PREFIX . 'css/app/home.js',
    ],
    'signup' => VIEW_PREFIX . 'signup.php'
]);

Router::configure();
Router::route();
?>
