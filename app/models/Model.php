<?php
namespace App\Models;

abstract class Model
{
    protected $fields = [];
    public function get($attribute_name){
        if(array_key_exists($attribute_name, $this->fields)){
            return $this->fields[$attribute_name];
        }
        else{
            return null;
        }
    }
    public function set($attribute_name, $value){
        $this->fields[$attribute_name] = $value;
        //var_dump($this->fields);
    }
}
?>