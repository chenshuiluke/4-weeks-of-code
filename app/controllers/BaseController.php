<?php
namespace App\Controllers;

class BaseController
{
    private static $views;
    public static function include_view($view, $data = null){
        $view_file = self::$views[$view];
        require VIEW_PREFIX . 'base.php';
    }

    public static function setViews($views){
        self::$views = $views;
    }
}
?>