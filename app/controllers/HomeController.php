<?php
namespace App\Controllers;
use \App\Views\HomeView;
class HomeController extends BaseController
{
    public static function index(){
        self::include_view('home');
    }
}
?>