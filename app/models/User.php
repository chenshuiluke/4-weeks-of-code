<?php
namespace App\Models;
class User implements Model
{
    public static function getTable(){
        return 'users';
    }

    public static function getFields(){
        return ['id', 'email', 'username'];
    }
}