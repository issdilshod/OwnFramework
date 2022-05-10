<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Dashboard;

class DashboardController extends Controller{

    private $modelDashboard;

    private function setModels(){
        $this->modelDashboard = new Dashboard();
    }

    public function indexAction(){
        $this->setModels();
        $vars = $this->modelDashboard->getUsers();
        // Another path to view
        //$this->view->path = 'path';
        $this->view->render('Dashboard', $vars);
    }
}