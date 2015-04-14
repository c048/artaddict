<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        
    }

    function index() {
        $this->view->artists = $this->model->aristList();
        
        $this->view->render('header');
        $this->view->render('blocks/logo');
        $this->view->render('blocks/nav');
        $this->view->render('index/index');
        $this->view->render('footer');
    }
}