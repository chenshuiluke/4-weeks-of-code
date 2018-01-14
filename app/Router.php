<?php
namespace App;
use App\Route;
class Router
{
    private static $routes;

    public static function configure(){
        self::$routes = [
            new Route('/', "App\Controllers\HomeController::index", 'GET'),
            new Route('/submissions/form', "App\Controllers\SubmissionController::index", 'GET'),
            new Route('/submissions/add', "App\Controllers\SubmissionController::add", 'POST'),
        ];
    }

    private static function getPath():string{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = filter_var($path, FILTER_SANITIZE_URL);

        return $path;
    }

    private static function getRequestType():string{
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function route(){
        foreach(self::$routes as $route){
            $path = self::getPath();
            if($route->match($path, self::getRequestType())){
                $route->process();
            }
        }
    }
}

?>