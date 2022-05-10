<?php
namespace app\controllers;

use app\core\Controller;

class DashboardController extends Controller{

    public function indexAction(){
        // Another path to view
        //$this->view->path = 'path';
        $this->view->render('Dashboard');
    }
}