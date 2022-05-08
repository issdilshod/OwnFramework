<?php
namespace app\controllers;

use app\core\Controller;

class DashboardController extends Controller{

    public function indexAction(){
        debug($this->route);
    }
}