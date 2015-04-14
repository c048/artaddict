<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->title = 'Login';
        
        $this->view->render('blocks/admin_header');
        $this->view->render('login/index');
        $this->view->render('blocks/admin_footer');
    }
    
    function run() {
        $this->model->run();
    }
}

