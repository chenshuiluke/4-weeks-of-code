<?php
namespace App;

class Route
{
    private $path;
    private $callback;
    private $method;

    public function __construct(string $path, $callback, $method = 'ANY'){
        $this->path = $path;
        $this->callback = $callback;
        $this->method = $method;
    }

    public function process(){
        call_user_func("{$this->callback}");
    }

    public function match($path, $request_type){
        if($this->path === $path && ($this->method === $request_type || $this->method === 'ANY')){
            return true;
        }
        return false;
    }
}
?>