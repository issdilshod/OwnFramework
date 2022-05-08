<?php

namespace app\core;

class Router{

    protected $routes = [];
    protected $params = [];

    public function __construct(){
        $arr = require_once 'app/config/routes.php';
        foreach ($arr as $key => $val){
            $this->add($key, $val);
        }
    }

    public function add($route, $param){
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $param;
    }

    public function match(){
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach($this->routes as $route => $param){
            if (preg_match($route, $url, $matches)){
                $this->params = $param;
                return true;
            }
        }
        return false;
    }

    public function run(){
        if($this->match()){
            $controller = 'app\controllers\\'. ucfirst($this->params['controller']).'Controller.php';
            if (class_exists($controller)){
                
            }else{
                // Class not found
            }
        }else{
            // Route not found
        }
    }

}