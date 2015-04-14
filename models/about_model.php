<?php

class About_Model extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function aristList() {
        
        $l_sSelect = 'SELECT artist_id, artist_name FROM artist ORDER BY artist_order ASC';
        
        return $this->db->select($l_sSelect);
        
    }
}