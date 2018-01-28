<?php

include_once "../vendor/autoload.php";
include_once "../app/autoloader.php";

use App\Controllers\BaseController;
use App\Router;
use App\Config;

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
session_start();

define('VIEW_PREFIX', '../app/views/');
define('HTML_ASSET_PREFIX', "/assets/");

Config::load();
Config::test();

BaseController::setViews([
    'home' => [
        'view' => VIEW_PREFIX . 'home.php',
        'css' => HTML_ASSET_PREFIX . 'css/app/home.css',
        'js' => HTML_ASSET_PREFIX . 'css/app/home.js',
    ],
    'add-submission' => [
        'view' => VIEW_PREFIX . 'add-submission.php',
        'css' => HTML_ASSET_PREFIX . 'css/app/add-submission.css',
    ],
    'edit-submission' => [
        'view' => VIEW_PREFIX . 'edit-submission.php',
        'css' => HTML_ASSET_PREFIX . 'css/app/edit-submission.css',
    ],
    'signup' => VIEW_PREFIX . 'signup.php',
    'submission' => [
        'view' => VIEW_PREFIX . 'submission_item.php',
        'css' => HTML_ASSET_PREFIX . 'css/app/submission_item.css',
    ],
    'not_found' => [
        'view' => VIEW_PREFIX . 'not_found.php',
    ],
    'unauthorized' => [
        'view' => VIEW_PREFIX . 'unauthorized.php',
    ],
    'about' => [
        'view' => VIEW_PREFIX . 'about.php',
        'css' => HTML_ASSET_PREFIX . 'css/app/about.css',
    ]
]);

Router::configure();
Router::route();
?>
