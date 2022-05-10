<?php
namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller{

    public function loginAction(){
        // Another path to layout
        // $this->view->layout = 'custom';
        $this->view->render('Login');
        // Redirect to another link
        // $this->view->redirect($url);
    }
}