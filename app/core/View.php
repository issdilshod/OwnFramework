<?php
namespace app\core;

class View{
    
    public $route;
    public $path;
    public $layout = 'default';

    public function __construct($route){
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = []){
        if (file_exists('app/views/' .  $this->path . '.php')){
            ob_start();
            require_once 'app/views/' .  $this->path . '.php';
            $content = ob_get_clean();
            require_once 'app/views/layouts/' . $this->layout . '.php';
        }else{
            // View file not exist
        }
    }

}