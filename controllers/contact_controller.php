<?php

class Contact extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        if(isset($_POST['submitButton'])) {
            $l_oContactMail = new SwiftMailer();
            $l_oContactMail->subject = 'Contact request';
            $l_oContactMail->name = $_POST['form_name'];
            $l_oContactMail->email = $_POST['form_email'];
            $l_oContactMail->message = $_POST['form_msg'];
            $l_sStatus = $l_oContactMail->validate();
            
            if(($l_sStatus)){
                $this->view->errorMail=$l_sStatus;
            } else {
                $l_sStatus = $l_oContactMail->contact();
                if($l_sStatus){
                    $this->view->errorMail='We appologise, but we were unable to connect to our mail server. Please contact us directly at info@artaddict.eu';
                } else {
                    $this->view->successMail='Your message has been submitted';
                }
            }
            
            if(!empty($_POST['form_name']) && ($l_sStatus)){
                $this->view->formName = $_POST['form_name'];
            }
            if(!empty($_POST['form_email']) && ($l_sStatus)){
                $this->view->formEmail = $_POST['form_email'];
            }
            if(!empty($_POST['form_msg']) && ($l_sStatus)){
                $this->view->formMsg = $_POST['form_msg'];
            }
        }
        $this->view->title = 'Contact';
        $this->view->background = 'bg7.jpg';
        $this->view->artists = $this->model->aristList();
        
        $this->view->render('header');
        $this->view->render('blocks/logo');
        $this->view->render('blocks/nav');
        $this->view->render('contact/index');
        $this->view->render('footer');
    }
}