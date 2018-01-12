<?php
namespace App\Models;
interface Model
{
    public static function getTable();
    public static function getFields();
}