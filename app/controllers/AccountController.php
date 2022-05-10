<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\DbMysqli;

class AccountController extends Controller{

    public function loginAction(){
        // $db = new DbMysqli();
        // $vars = $db->query("SELECT * FROM users")->rows;

        // Another path to layout
        // $this->view->layout = 'custom';

        $this->view->render('Login');

        // Redirect to another link
        // $this->view->redirect($url);
    }
}