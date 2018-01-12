<?php
namespace App\Controllers;

class BaseController
{
    private static $views;
    public static function include_view($view, $data = null){
        require self::$views[$view];
    }

    public static function setViews($views){
        self::$views = $views;
    }
}
?>