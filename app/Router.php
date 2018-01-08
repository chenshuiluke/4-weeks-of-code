<?php
namespace App;
use App\Route;
class Router
{
    private static $routes;

    public static function configure(){
        self::$routes = [
            new Route('/', "App\Controllers\HomeController::index")
        ];
    }

    private static function getPath():string{
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function route(){
        foreach(self::$routes as $route){
            $path = self::getPath();
            if($route->match($path)){
                $route->process();
            }
        }
    }
}

?>