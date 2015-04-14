<?php

class Admin_Article extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }
    
    public function index() {
        
        $l_aSort = null;
        $l_nListRows = 12;
        
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
            $this->view->sort = 'article_id';
            $this->view->order = 'asc';
            $this->view->linkOrder= 'desc';
        }
        
        $this->view->title = 'Articles';
        $this->view->articleList= $this->model->articleList($l_aSort, $l_nPage, $l_nListRows);
        $this->view->pageCount = array('current' => $l_nPage, 'total' => ceil((count($this->model->articleList()))/$l_nListRows));
        $this->view->js[0] = 'script_base';
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_article/index');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function create() {
        
        if (isset($_POST['article_submit'])) {
            $this->save();
        }
        
        $this->view->title = 'Add Article';
        $this->view->js[0] = 'script_base';
        $this->view->artistList = $this->model->articleArtistSelection();
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_article/create');
        $this->view->render('blocks/admin_footer');
        
    }
    
    private function save($p_nId = null) {
        
        try {
                
            $l_oValidator = new Form();
            $l_oValidator->post('article_name');
            $l_oValidator->val('minLength', 1);
            if(empty($p_nId)) {

                $l_oValidator->file('article_img');
                $l_oValidator->val('validFile');
                
            } else if (!empty($_FILES['article_img']['name'])) {
                
                $l_oValidator->file('article_img');
                $l_oValidator->val('validFile');
                
            }
            $l_oValidator->submit();

        } catch (arrayException $e) {

            $l_sError = $e->getResults();

        }
        
        if (isset($l_sError)) {
            $this->view->errorMsg = $l_sError;
        } else {
            $data = array();
            $data['article_name'] = $_POST['article_name'];
            if(empty($data['article_price'])) {
                $data['article_price'] = 0;
            } else {
                $data['article_price'] = $_POST['article_price'];
            }
            $data['article_description'] = $_POST['article_description'];
            $data['artist_id'] = $_POST['artist_id'];
            if(!empty($_FILES['article_img']['name'])) {
                $data['article_img'] = $_FILES['article_img'];
            }
            if(!empty($p_nId)) {
                if(!empty($_FILES['article_img']['name'])) {
                    $this->model->delete($p_nId, 1);
                }
                
                $data['article_id'] = $p_nId;
                $this->model->editSave($data);
                
            } else {
                $this->model->create($data);
            }
            
            header('location: ' . URL . 'admin_article');
        }
        
    }
    
    public function edit($p_nId = 0) {
        
        if (isset($_POST['article_submit'])) {
            $this->save($p_nId);
        }
        
        $this->view->article = $this->model->articleSingleList($p_nId);
        
        if(empty($this->view->article)) {
            header('location: ' . URL . 'admin_article');
        }
        
        $this->view->title = 'Edit ' . $this->view->article['article_name'];
        $this->view->js[0] = 'script_base';
        $this->view->artistList = $this->model->articleArtistSelection();
        
        $this->view->render('blocks/admin_header');
        $this->view->render('blocks/admin_nav');
        $this->view->render('blocks/admin_control');
        $this->view->render('admin_article/edit');
        $this->view->render('blocks/admin_footer');
        
    }
    
    public function delete($id) {
        
        $this->model->delete($id);
        header('location: ' . URL . 'admin_article');
        
    }
}