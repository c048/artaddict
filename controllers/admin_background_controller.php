<?php

class Admin_Background extends Controller {

    function __construct() {
        
        parent::__construct();
        Auth::handleLogin();
        
    }
    
    public function index() {
        
        $l_aSort = null;
        $l_nRows = 20;
        
        if(isset($_GET['page']) && $_GET['page']>1) {
            
            $l_nPage = $_GET['page'];
            
        } else {
            
            $l_nPage = 1;
            
        }
        
        if(isset($_GET['sort'])) {
            
            $this->view->sort = $_GET['sort'];
            
            if(isset($_GET['order']) && $_GET['order'] == 'asc') {
                
                $this->view->order= 'desc';
                $l_aSort = array('sort' => $_GET['sort'], 'order' => 'asc');
                
            } else {
                
                $this->view->order= 'asc';
                $l_aSort = array('sort' => $_GET['sort'], 'order' => 'desc');
                
            }
            
        } else {
            
            $this->view->sort = 'background_name';
            $this->view->order = 'desc';
            
        }
        
        $this->view->title = 'Backgrounds';
        $this->view->backgroundList = $this->model->backgroundList($l_aSort, $l_nPage, $l_nRows);
        $this->view->pageCount = array('current' => $l_nPage, 'total' => ceil((count($this->model->backgroundList()))/$l_nRows));
        $this->view->js[0] = 'script_base';
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_background/index');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function save($p_nId = null) {
        
        try {
            
            $l_oValidator = new Form();
            $l_oValidator->post('background_name');
            $l_oValidator->val('minLength', 2);
            if(!empty($_FILES['background_img']['name']) ) {
                $l_oValidator->file('background_img');
                $l_oValidator->val('validFile');
            }
            $l_oValidator->submit();
            
        } catch (arrayException $e) {
            
            $l_sError = $e->getResults();
            
        }
        
        if (isset($l_sError)) {
            
            $this->view->errorMsg = $l_sError;
            
        } else {
            
            $l_aData = array();
            $l_aData['background_name'] = $_POST['background_name'];
            
            if(!empty($p_nId)) {
                
                $l_aData['background_id'] = $p_nId;
                if(!empty($_FILES['background_img']['name'])) {
                    
                    $l_aData['background_img'] = $_FILES['background_img'];
                    $this->model->delete($p_nId, 1);
                    
                }
                
            } else {
                $l_aData['background_img'] = $_FILES['background_img'];
            }
            
            if(!empty($p_nId)) {
                $this->model->backgroundEdit($l_aData);
            } else {
                $this->model->backgroundCreate($l_aData);
            }
            
            header('location: ' . URL . 'admin_background');
            
        }
        
    }
    
    public function create() {
        
        if (isset($_POST['background_submit'])) {
            
            $this->save();
            
        }
        
        $this->view->title = 'Add Background';
        $this->view->js[0] = 'script_base';
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_background/create');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function edit($p_nId = null) {
        
        if (isset($_POST['background_submit'])) {
            
            $this->save($p_nId);
            
        }
        
        $this->view->background = $this->model->backgroundSingleList($p_nId);
        
        if(empty($this->view->background)) {
            header('location: ' . URL . 'admin_background');
        }
        
        $this->view->title = 'Edit Background';
        $this->view->js[0] = 'script_base';
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_background/edit');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function delete($id) {
        
        $this->model->delete($id);
        header('location: ' . URL . 'admin_background');
        
    }
    
}