<?php
namespace app\models;

use app\core\Model;

class Dashboard extends Model{

    public function getUsers(){
        return $this->db->query("SELECT * FROM users")->rows;
    }
}