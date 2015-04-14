<?php

class Admin_Artist extends Controller {

    function __construct() {
        
        parent::__construct();
        Auth::handleLogin();
        
    }
    
    public function index() {
        
        $l_aSort = null;
        $l_nListRows = 20;
        
        if(isset($_GET['page']) && $_GET['page']>1) {
            $l_nPage = $_GET['page'];
        } else {
            $l_nPage = 1;
        }
        
        if(isset($_GET['sort'])) {
            $this->view->sort = $_GET['sort'];
            
            if(isset($_GET['order']) && $_GET['order'] == 'asc') {
                $this->view->order= 'asc';
                $this->view->linkOrder= 'desc';
                $l_aSort = array('sort' => $_GET['sort'], 'order' => 'asc');
            } else {
                $this->view->order= 'desc';
                $this->view->linkOrder= 'asc';
                $l_aSort = array('sort' => $_GET['sort'], 'order' => 'desc');
            }
        } else {
            $this->view->sort = 'artist_order';
            $this->view->order = 'asc';
            $this->view->linkOrder= 'desc';
        }
        
        $this->view->title = 'Artists';
        $this->view->artistList = $this->model->artistList($l_aSort, $l_nPage, $l_nListRows);
        $this->view->pageCount = array('current' => $l_nPage, 'total' => ceil((count($this->model->artistList()))/$l_nListRows));
        $this->view->js[0] = 'script_base';
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_artist/index');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function ordering() {
        
        if(isset($_GET['pos']) || isset($_GET['move'])) {
            $this->model->aristOrderChange($_GET['pos'], $_GET['move']);
            header('location: ' . URL . 'admin_artist&sort=' . $_GET['sort'] . '&order=' . $_GET['order'] . '&page=' . $_GET['page']);
        } else {
            header('location: ' . URL . 'admin_artist');
        }
        
    }
    
    public function create() {
        
        if (isset($_POST['artist_submit'])) {
            $this->save();
        }
        
        $this->view->title = 'Add artist';
        $this->view->js[0] = 'script_base';
        $this->view->backgroundList = $this->model->artistBackgroundSelection();
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_artist/create');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function save($p_nId = null) {
        
        try {
            
            $l_oValidator = new Form();
            $l_oValidator->post('artist_name');
            $l_oValidator->val('minLength', 2);
            $l_oValidator->submit();
            
        } catch (arrayException $e) {
            
            $l_sError = $e->getResults();
            
        }
        
        if (isset($l_sError)) {
            
            $this->view->errorMsg = $l_sError;
            
        } else {

            $l_aData = array();
            if(!empty($p_nId)) {
                
                $l_aData['artist_id'] = $p_nId;
                
            }
            $l_aData['artist_name'] = $_POST['artist_name'];
            $l_aData['artist_description'] = $_POST['artist_description'];
            $l_aData['background_id'] = $_POST['background_id'];
            
            if(!empty($p_nId)) {
                
                $this->model->edit($l_aData);
                
            } else {
                
                $this->model->create($l_aData);
                
            }
            
            header('location: ' . URL . 'admin_artist');
            
        }
        
    }
    
    public function edit($p_nId) {
        
        if(isset($_POST['artist_submit'])) {
            $this->save($p_nId);
        }
        
        $this->view->artist = $this->model->artistSingleList($p_nId);
        
        if(empty($this->view->artist)) {
            header('location: ' . URL . 'admin_artist');
        }
        
        $this->view->title = 'Edit ' . $this->view->artist['artist_name'];
        $this->view->js[0] = 'script_base';
        $this->view->backgroundList = $this->model->artistBackgroundSelection();
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_artist/edit');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function delete($id) {
        
        $this->model->delete($id);
        header('location: ' . URL . 'admin_artist');
        
    }
    
    function logout() {
        
        Session::destroy();
        header('location: ' . URL . 'login');
        exit;
        
    }
}