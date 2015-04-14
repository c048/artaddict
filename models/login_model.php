<?php

class Login_Model extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function run() {
        $l_oSth = $this->db->prepare("SELECT user_id, role_id FROM user WHERE user_name = :name AND user_pwd = :password");
        $l_oSth->execute(array(
           ':name' => $_POST['login'],
           ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
        ));
        
        $data = $l_oSth->fetch();
        
        $count = $l_oSth->rowCount();
        if($count > 0){
            Session::init();
            Session::set('role_id', $data['role_id']);
            Session::set('loggedIn', true);
            Session::set('user_id', $data['user_id']);
            Session::set('user_name', $_POST['login']);
            header('location: ' . URL . 'admin_artist');
        } else {
            header('location: ' . URL . 'login');
        }
    }
   
}