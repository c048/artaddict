<?php

class Events extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->title = 'Events';
        $this->view->background = 'bg6.jpg';
        $this->view->artists = $this->model->aristList();        
        
        $this->view->render('header');
        $this->view->render('blocks/logo');
        $this->view->render('blocks/nav');
        $this->view->render('events/index');
        $this->view->render('footer');
    }
}