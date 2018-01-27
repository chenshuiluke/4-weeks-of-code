<?php
namespace App;
use App\Route;
use App\Controllers\BaseController;
class Router
{
    private static $routes;

    public static function configure(){
        self::$routes = [
            new Route('/', "App\Controllers\HomeController::index", 'GET'),
            new Route('/submissions/form', "App\Controllers\SubmissionController::index", 'GET'),
            new Route('/submissions/add', "App\Controllers\SubmissionController::add", 'POST'),
            new Route('/logout', "App\Controllers\HomeController::logout", 'GET'),
            new Route('/submission/view', "App\Controllers\SubmissionController::view", 'GET'),
            new Route('/submission/delete', "App\Controllers\SubmissionController::delete", 'POST'),
            new Route('/not_found', "App\Controllers\BaseController::notFound", 'GET'),
            new Route('/unauthorized', "App\Controllers\BaseController::unauthorized", 'GET')
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
                return $route->process();
            }
        }
        return BaseController::redirect('/not_found');
    }
}

?>