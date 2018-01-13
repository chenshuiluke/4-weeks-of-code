<?php
namespace App\Util;
use \Dotenv\Dotenv;

class DatabaseUtilities
{
    public static function getPDOInstance(){
        static $instance;
        if(isset($instance)){
            return $instance;
        }
        $dotenv = new Dotenv('..');
		$dotenv->load();

        $host=getenv('DB_HOST');
        $database=getenv('DB_NAME');
        $username=getenv('DB_USER');
        $password=getenv('DB_PASS');
        $charset="utf8mb4";
        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
        $instance = new \PDO($dsn, $username, $password);
        $instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $instance;
    }
}
?>
