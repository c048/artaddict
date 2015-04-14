<?php

class Admin_Background_Model extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function backgroundList($p_aSort = null, $p_nFLim = 0, $p_nCLim = 20) {
        
        $l_sSelect = 'SELECT background_id, background_name, background_img FROM background';
        $l_aVars = array();
        
        if (!empty($p_aSort)) {
            $l_sSelect .= ' ORDER BY ' . $p_aSort['sort'] . ' ' . $p_aSort['order'];
        } else {
            $l_sSelect .= ' ORDER BY background_name ASC';
        }
        
        if (!empty($p_nFLim)) {
            $l_sSelect .= ' LIMIT :floor,:ceiling';
            $l_aVars['floor'] = array('val' => ($p_nFLim-1)*$p_nCLim, 'type' => 'int');
            $l_aVars['ceiling'] = array('val' => $p_nCLim, 'type' => 'int');
        }
        
        return $this->db->select($l_sSelect, $l_aVars);
        
    }
    
    public function backgroundSingleList($id) {
        
        $l_aResult = $this->db->select('SELECT background_id, background_name, background_img FROM background WHERE background_id = :id', array('id' => $id));
        
        if(!empty($l_aResult)) {
            return $l_aResult[0];
        } else {
            return 0;
        }
    }
    
    public function backgroundCreate($data) {
        
        $l_sFileName = (date("H:i:s")*rand(2,189)*3215).$data['background_img']['name'];
        $l_sUploadPath = ROOT . '/public/assets/bkgrnd/';
        move_uploaded_file($data['background_img']['tmp_name'], $l_sUploadPath . $l_sFileName);
        
        $this->db->insert('background', array(
            'background_name' => $data['background_name'],
            'background_img' => $l_sFileName
        ));
        
    }
    
    public function backgroundEdit($data) {
        
        if (isset($data['background_img'])) {
            $l_sFileName = (date("H:i:s")*rand(2,189)*3215).$data['background_img']['name'];
            $l_sUploadPath = ROOT . '/public/assets/bkgrnd/';
            move_uploaded_file($data['background_img']['tmp_name'], $l_sUploadPath . $l_sFileName);
        
            $this->db->update('background', array(
                'background_name' => $data['background_name'],
                'background_img' => $l_sFileName
            ), "background_id = {$data['background_id']}");
            
        } else {
            $this->db->update('background', array(
            'background_name' => $data['background_name'],
            ), "background_id = {$data['background_id']}");
        }
        
    }
    
    public function delete($p_nId, $p_bImageOnly = 0, $p_nLimit = 1) {
        
        $data = $this->db->select('SELECT background_img FROM background WHERE background_id = :id', array('id' => $p_nId));
        $l_sUploadPath = ROOT . '/public/assets/bkgrnd/' . $data[0]['background_img'];
        
        if(!empty($l_sUploadPath)){
            unlink($l_sUploadPath);
        }
        
        if($p_bImageOnly==0){
            $this->db->update('artist', array('background_id' => 0), "background_id = $p_nId");
            $this->db->delete('background', "background_id = $p_nId");
        }
        
    }
   
}