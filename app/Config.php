<?php
namespace App;
use \Dotenv\Dotenv;
class Config
{
    public static $servicesCredentials;

    public static function load(){
		$dotenv = new Dotenv('..');
		$dotenv->load();
        self::$servicesCredentials = array(
            'github' => array(
                'key'       => getenv('GITHUB_KEY'),
                'secret'    => getenv('GITHUB_SECRET'),
            )
        );
    }
}

?>
