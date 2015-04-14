<?php

class Admin_Article_Model extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function articleList($p_aSort = null, $p_nFLim = 0, $p_nCLim = 20) {
        
        $l_sSelect = 'SELECT p.article_id, p.article_name, p.article_description, p.article_price, p.article_img, a.artist_name FROM article AS p LEFT JOIN artist AS a ON p.artist_id = a.artist_id';
        $l_aVars = array();
        
        if (!empty($p_aSort) && $p_aSort['sort'] != 'article_name') {
            $l_sSelect .= ' ORDER BY ' . $p_aSort['sort'] . ' ' . $p_aSort['order'] . ', article_name ' . $p_aSort['order'];;
        } else {
            if (!empty($p_aSort)) {
                $l_sSelect .= ' ORDER BY ' . $p_aSort['sort'] . ' ' . $p_aSort['order'];
            } else {
                $l_sSelect .= ' ORDER BY article_id ASC ';
            }
        }
        
        if (!empty($p_nFLim)) {
            $l_sSelect .= ' LIMIT :floor,:ceiling';
            $l_aVars['floor'] = array('val' => ($p_nFLim-1)*$p_nCLim, 'type' => 'int');
            $l_aVars['ceiling'] = array('val' => $p_nCLim, 'type' => 'int');
        }
        
        return $this->db->select($l_sSelect, $l_aVars);
        
    }
    
    public function articleSingleList($p_nId) {
        $l_aResult = $this->db->select('SELECT article_id, article_name, article_description, article_img, artist_id, article_price FROM article WHERE article_id = :id', array('id' => $p_nId));
        
        if(!empty($l_aResult)){
            return $l_aResult[0];
        }
        else {
            return 0;
        }
    }
    
    public function articleArtistSelection() {
        
        $l_sSelect = 'SELECT artist_id, artist_name FROM artist';
        
        return $this->db->select($l_sSelect);
        
    }
    
    public function create($data) {
        $imgUploader = new FileUpload($data['article_img']['name'], $data['article_img']['tmp_name']);
        $l_sNewFileName = $imgUploader->image(ROOT . '/public/assets/product/');
        $imgUploader->image(ROOT . '/public/assets/product/thumb/', 81, 71);
        
        $this->db->insert('article', array(
            'article_name' => $data['article_name'],
            'article_price' => $data['article_price'],
            'article_description' => $data['article_description'],
            'artist_id' => $data['artist_id'],
            'article_img' => $l_sNewFileName
        ));
        
    }
    
    public function editSave($data) {
        
        if (isset($data['article_img'])) {
            
            $imgUploader = new FileUpload($data['article_img']['name'], $data['article_img']['tmp_name']);
            $l_sNewFileName = $imgUploader->image(ROOT . '/public/assets/product/');
            $imgUploader->image(ROOT . '/public/assets/product/thumb/', 81, 71);
            
            $this->db->update('article', array(
                'article_name' => $data['article_name'],
                'article_price' => $data['article_price'],
                'artist_id' => $data['artist_id'],
                'article_description' => $data['article_description'],
                'article_img' => $l_sNewFileName
            ), "article_id = {$data['article_id']}");
            
        } else {
            
            $this->db->update('article', array(
                'article_name' => $data['article_name'],
                'article_price' => $data['article_price'],
                'artist_id' => $data['artist_id'],
                'article_description' => $data['article_description']
            ), "article_id = {$data['article_id']}");
            
        }
        
    }
    
    public function delete($p_nId, $p_bImageOnly = 0, $p_nLimit = 1) {
        
        $data = $this->db->select('SELECT article_img FROM article WHERE article_id = :id', array('id' => $p_nId));
        $l_sUploadPath = ROOT . '/public/assets/product/' . $data[0]['article_img'];
        $l_sThumbUploadPath = ROOT . '/public/assets/product/thumb/' . preg_replace('/\\.[^.\\s]{3,4}$/', '', $data[0]['article_img']) . '.jpg';
        
        if(!empty($l_sUploadPath)){
            
            if(file_exists ( $l_sUploadPath ))
                unlink($l_sUploadPath);
            
            if(file_exists ( $l_sThumbUploadPath ))
                unlink($l_sThumbUploadPath);
            
        }
        
        if($p_bImageOnly==0){
            
            $this->db->delete('article', "article_id = $p_nId");
            
        }
        
    }
   
}