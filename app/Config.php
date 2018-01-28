<?php
namespace App;
use \Dotenv\Dotenv;
use \Exception;
class Config
{
    public static $servicesCredentials;
    public static $coinhiveSecret;
    public static function load(){
		$dotenv = new Dotenv('..');
		$dotenv->load();
        self::$servicesCredentials = array(
            'github' => array(
                'key'       => getenv('GITHUB_KEY'),
                'secret'    => getenv('GITHUB_SECRET'),
            )
        );
        self::$coinhiveSecret = getenv('COINHIVE_SECRET');
    }
    public static function test(){
        if(!self::$servicesCredentials['github']){
            throw new Exception("GitHub service credentials not set.");
        }
        if(!self::$servicesCredentials['github']['key'] || !self::$servicesCredentials['github']['secret']){
            throw new Exception("GitHub service credentials not set.");
        }
        if(!self::$coinhiveSecret){
            throw new Exception("CoinHive secret not set.");
        }
    }
}

?>
