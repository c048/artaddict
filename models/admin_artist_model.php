<?php

class Admin_Artist_Model extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function artistList($p_aSort = null, $p_nFLim = 0, $p_nCLim = 20) {
        
        $l_sSelect = 'SELECT a.artist_id, a.artist_name, a.artist_description, a.artist_order, b.background_name FROM artist AS a LEFT JOIN background AS b ON a.background_id = b.background_id';
        $l_aVars = array();
        
        if (!empty($p_aSort)) {
            $l_sSelect .= ' ORDER BY ' . $p_aSort['sort'] . ' ' . $p_aSort['order'];
        } else {
            $l_sSelect .= ' ORDER BY artist_order ASC ';
        }
        
        if (!empty($p_nFLim)) {
            $l_sSelect .= ' LIMIT :floor,:ceiling';
            $l_aVars['floor'] = array('val' => ($p_nFLim-1)*$p_nCLim, 'type' => 'int');
            $l_aVars['ceiling'] = array('val' => $p_nCLim, 'type' => 'int');
        }
        
        return $this->db->select($l_sSelect, $l_aVars);
        
    }
    
    public function artistSingleList($id) {
        
        $l_aResult = $this->db->select('SELECT artist_id, artist_name, artist_description, background_id FROM artist WHERE artist_id = :id', array('id' => $id));
        
        if(!empty($l_aResult)) {
            return $l_aResult[0];
        } else {
            return 0;
        }
        
    }
    
    public function artistBackgroundSelection() {
        
        $l_sSelect = 'SELECT background_id, background_name FROM background ORDER BY background_name ASC';
        
        return $this->db->select($l_sSelect);
        
    }
    
    public function aristOrderChange($p_nPos, $p_sDirection) {
        
        $l_sSelect = 'SELECT artist_id, artist_order FROM artist WHERE artist_order ';
        
        if($p_sDirection=='up') {
            $l_sSelect .= '< :pos ORDER BY artist_order DESC LIMIT 1';
        } else {
            $l_sSelect .= '> :pos ORDER BY artist_order ASC LIMIT 1';
        }
        
        $l_aReplace = $this->db->select($l_sSelect, array('pos' => $p_nPos));
        
        if (!empty ($l_aReplace)) {
            try {
                $this->db->update('artist', array('artist_order' => ($l_aReplace[0]['artist_order'])), "artist_order = $p_nPos");
                $this->db->update('artist', array('artist_order' => $p_nPos), "artist_id = {$l_aReplace[0]['artist_id']}");
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
        }
    }
    
    public function create($data) {
        
        $l_aLowestOrder = $this->artistList(array('sort' => 'artist_order','order' => 'desc', 0, 1));
        $l_nNewOrder = $l_aLowestOrder[0]['artist_order'] + 1;
        
        $this->db->insert('artist', array(
            'artist_name' => $data['artist_name'],
            'artist_order' => $l_nNewOrder,
            'artist_description' => $data['artist_description'],
            'background_id' => $data['background_id']
        ));
        
    }
    
    public function edit($data) {
        $this->db->update('artist', array(
            'artist_name' => $data['artist_name'],
            'artist_description' => $data['artist_description'],
            'background_id' => $data['background_id'],
        ), "artist_id = {$data['artist_id']}");
    }
    
    public function delete($id) {
        $this->db->update('article', array('artist_id' => 0), "artist_id = $id");
        $this->db->delete('artist', "artist_id = $id");
    }
   
}