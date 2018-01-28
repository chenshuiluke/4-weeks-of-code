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

    protected static function escapeInput($data, $encoding='UTF-8'){
        return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);
    }

    protected static function escapeArr($arr){
        $new_arr = [];
        foreach($arr as $key => $val){
            $new_arr[$key] = self::escapeInput($val);
        }
        return $new_arr;
    }

    public static function redirect($url = "/", $statusCode = 303)
    {
       header('Location: ' . $url, true, $statusCode);
       die();
    }

    public static function notFound(){
        self::include_view('not_found');
    }

    public static function unauthorized(){
        self::include_view('unauthorized');
    }    

    public static function about(){
        self::include_view('about');
    }
}
?>