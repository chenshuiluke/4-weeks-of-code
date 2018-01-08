<?php
namespace App;

class Route
{
    private $path;
    private $callback;
    public function __construct(string $path, $callback){
        $this->path = $path;
        $this->callback = $callback;
    }

    public function process(){
        call_user_func("{$this->callback}");
    }

    public function match($path){
        if($this->path === $path){
            return true;
        }
        return false;
    }
}
?>