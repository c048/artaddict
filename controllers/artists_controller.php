<?php

class Artists extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->title = 'Artists';
        $this->view->background = 'bg2.jpg';
        $this->view->artists = $this->model->aristList();
        
        $this->view->render('header');
        $this->view->render('blocks/logo');
        $this->view->render('blocks/nav');
        $this->view->render('artists/index');
        $this->view->render('footer');
    }
    
    function view($p_nId) {
        $this->view->artists = $this->model->aristList();
        $this->view->artist = $this->model->artistSingleList($p_nId);
        $this->view->title = $this->view->artist['artist_name'];
        $this->view->products = $this->model->artistProducts($p_nId);
        $this->view->js = array('jquery-2.1.1.min', 'leapCart/js/leapCart', 'leapViewer/js/leapViewer');
        
        $this->view->render('header');
        $this->view->render('blocks/logo');
        $this->view->render('blocks/nav');
        $this->view->render('artists/view');
        $this->view->render('footer');
    }
    
    function xhrEmail() {
        $l_aProducts = $this->model->allProducts();
        $l_aSortedProducts = array();
        $l_aItems = array();
        
        foreach ($l_aProducts as $key => $value) {
            
            $l_aSortedProducts[$value['article_id']] = array('article_name' => $value['article_name'], 'article_price' => $value['article_price']);
        }
        
        $l_oContactMail = new SwiftMailer();
        $l_oContactMail->subject = 'Product Order';
        $l_oContactMail->name = $_POST['form_name'] . " " . $_POST['form_surname'];
        $l_oContactMail->company = $_POST['form_company'];
        $l_oContactMail->address = $_POST['form_address'];
        $l_oContactMail->zip = $_POST['form_zip'];
        $l_oContactMail->city = $_POST['form_city'];
        $l_oContactMail->country = $_POST['form_country'];
        $l_oContactMail->email = $_POST['form_email'];
        $l_oContactMail->phone = $_POST['form_phone'];
        $l_oContactMail->message = $_POST['form_msg'];
        $l_oContactMail->items = $_POST['form_items'];
        
        foreach ($_POST['form_items'] as $key => $value) {
            
            $l_aItems[] = array('name' => $l_aSortedProducts[$value[0]]['article_name'], 'price' => intval($l_aSortedProducts[$value[0]]['article_price']), 'quantity' => intval($value[1]));
            
        }
        
        $l_oContactMail->items = $l_aItems;
        $l_sStatus = $l_oContactMail->validate(0);
        
        if(($l_sStatus)){
            echo 1;
        } else {
            $l_sStatus = $l_oContactMail->order();
            if($l_sStatus){
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    
}