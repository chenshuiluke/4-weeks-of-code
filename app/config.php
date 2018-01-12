<?php
namespace App;
class Config
{
    public static $servicesCredentials;

    public static function load(){
        self::$servicesCredentials = array(
            'github' => array(
                'key'       => '',
                'secret'    => '',
            )
        );
    }
}

?>