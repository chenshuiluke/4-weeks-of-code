<?php

include_once "../vendor/autoload.php";
include_once "../app/autoloader.php";

use App\Controllers\BaseController;
use App\Router;
use App\Config;

define('VIEW_PREFIX', '../app/views/');

Config::load();
BaseController::setViews([
    'home' => VIEW_PREFIX . 'home.php',
    'signup' => VIEW_PREFIX . 'signup.php'
]);

Router::configure();
Router::route();
?>