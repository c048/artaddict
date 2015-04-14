<?php

class Artists_Model extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function aristList() {
        
        $l_sSelect = 'SELECT artist_id, artist_name, artist_description, background_id FROM artist ORDER BY artist_order ASC';
        return $this->db->select($l_sSelect);
        
    }
    
    public function artistSingleList($p_nId) {
        $l_aResult = $this->db->select('SELECT a.artist_id, a.artist_name, a.artist_description, b.background_img FROM artist AS a LEFT JOIN background AS b ON a.background_id = b.background_id WHERE artist_id = :id', array('id' => $p_nId));
        if(!empty($l_aResult)) {
            return $l_aResult[0];
        }
    }
    
    public function artistProducts($p_nId) {
        
        return $this->db->select('SELECT article_id, article_name, article_description, article_price, article_img FROM article WHERE artist_id = :id', array('id' => $p_nId));
    
    }
    
    public function allProducts() {
        
        return $this->db->select('SELECT article_id, article_name, article_price FROM article');
    
    }
}