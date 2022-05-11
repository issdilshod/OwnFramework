<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Account;

class AccountController extends Controller{

    private $modelAccount;

    private function setModels(){
        $this->modelAccount = new Account();
    }

    public function loginAction(){
        $this->setModels();
        //$vars = $this->modelAccount->getUsers();
        // Another path to layout
        // $this->view->layout = 'custom';
        $this->view->render('Login');
        // Redirect to another link
        // $this->view->redirect($url);
    }
}