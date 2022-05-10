<?php

namespace app\core;

use app\core\View;

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

    public function find(){
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
        if($this->find()){
            $path = 'app\controllers\\'. ucfirst($this->params['controller']).'Controller';
            if (class_exists($path)){
                $action = $this->params['action'] . 'Action';
                if (method_exists($path, $action)){
                    $controller = new $path($this->params);
                    $controller->$action();
                }else{
                    // Method not found
                    View::error(404);
                }
            }else{
                // Class not found
                View::error(404);
            }
        }else{
            // Route not found
            View::error(404);
        }
    }

}