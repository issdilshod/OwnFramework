<?php
namespace app\models;

use app\core\Model;

class Account extends Model{

    private $profile = [];
    private $config = [];

    public function __construct(){
        $this->__loadParentModel();
        $this->__loadClass();
    }

    private function __loadClass(){
        if (isset($_SESSION['user_id'])) {
            $tmp = $this->db->query("SELECT u.user_id, u.username, u.role, u.name, u.created_at, u.updated_at, u.status FROM users u WHERE u.user_id='".(int)$_SESSION['user_id']."'")->row;
			$this->profile['user_id'] = (int)$tmp['user_id'];
            $this->profile['username'] = $tmp['username'];
            $this->profile['user_role'] = (int)$tmp['role'];
            $this->profile['status'] = (int)$tmp['status'];
            $this->config = require_once 'app/config/account.php';
        } else {
            $this->logOut();
        }
    }

    public function logIn($data){
        $tmp = $this->db->query("SELECT u.user_id, u.username, u.role, u.name, u.created_at, u.updated_at, u.status FROM users u WHERE u.username='".$this->db->escape($data['username'])."' AND u.password='".$this->db->escape($data['password'])."' AND u.status='".$this->config['active']."'");
        if ($tmp->num_rows) {
			$_SESSION['user_id'] = $tmp->row['user_id'];
            $this->profile['user_id'] = (int)$tmp['user_id'];
            $this->profile['username'] = $tmp['username'];
            $this->profile['user_role'] = (int)$tmp['role'];
            $this->profile['status'] = (int)$tmp['status'];
			$this->db->query("INSERT INTO user_activity ua(ua.user_id, ua.description, ua.created_at, ua.status) VALUES(".$this->profile['user_id'].",'Logged in ".$this->getUserAgent()." ".$this->getUserIP()."','".$this->ifunc->currentTime()."', '".$this->config['active']."')");
		}else{
			return false;
		}
		return true;
    }

    public function logOut(){
        unset($_SESSION['user_id']);
		$this->profile = null;
    }

    public function isLogin(){
        if(isset($this->profile['user_id']) && $this->profile['user_id']!=null){
			return true;
		} else {
			return false;
		}
    }

    public function getUserProfile(){
        return $this->profile;
    }

    public function getUserAgent(){
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function getUserIP()
	{
	    // Get real visitor IP behind CloudFlare network
	    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
	              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	    }
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];

	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }

	    return $ip;
	}
}