<?php

namespace app\core;

use app\lib\DbMysqli;

abstract class Model{

    public $db;

    public function __construct(){
        $this->db = new DbMysqli();
    }
}