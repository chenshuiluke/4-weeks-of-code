<?php
namespace App\Util;

class DatabaseUtilities
{
    public static function getPDOInstance(){
        static $instance;
        if(isset($instance)){
            return $instance;
        }

        $host="localhost";
        $database="four_weeks";
        $username="four_weeks_user";
        $password="password";
        $charset="utf8mb4";
        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";

        $instance = new \PDO($dsn, $username, $password);
        $instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $instance;
    }
}
?>