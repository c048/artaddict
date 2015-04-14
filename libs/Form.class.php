<?php

require ('Form/Val.php');
class Form {
    
    /** @var array $m_aCurrentItem The immediately posted item */
    private $m_aCurrentItem = null;
    
    /** @var array $m_aPostData Stores the Posted Data */
    private $m_aPostData = array();
    
    /** @var array $m_oVal The validator object */
    private $m_oVal = array();
    
    /** @var array $m_aError Holds the current forms errors */
    private $m_aError = array();

    /**
     * The constructor
     */
    function __construct() {
        $this->m_oVal = new Val();
    }
    
    /**
     * This is to run $_POST
     * @param string $p_sField The HTML fieldname to post
     */
    public function post($p_sField) {
        $this->m_aPostData[$p_sField] = $_POST[$p_sField];
        $this->m_aCurrentItem = $p_sField;
        return $this;
    }
    
    /**
     * This is to run $_POST
     * @param string $p_sField The HTML fieldname to post
     */
    public function file($p_sFile) {
        $this->m_aPostData[$p_sFile] = $_FILES[$p_sFile]['name'];
        $this->m_aCurrentItem = $p_sFile;
        return $this;
    }
    
    /**
     * fetch - Return the posted data
     * @param mixed $p_aFieldName
     * @return mixed String or array
     */
    public function fetch($p_aFieldName = false) {
        if ($p_aFieldName) {
            if (isset($this->m_aPostData['$p_aFieldName'])) {
                return $this->m_aPostData['$p_aFieldName'];
            } else {
                return false;
            }
        } else {
            return $this->m_aPostData;
        }
    }
    
    /**
     * This is to validate
     */
    public function val($p_sTypeOfValidator, $p_sArg = null) {
        if ($p_sArg == null) {
            $l_aError = $this->m_oVal->{$p_sTypeOfValidator}($this->m_aPostData[$this->m_aCurrentItem]);
        } else {
            $l_aError = $this->m_oVal->{$p_sTypeOfValidator}($this->m_aPostData[$this->m_aCurrentItem], $p_sArg);
        }
        
        if ($l_aError) {
            $this->m_aError[$this->m_aCurrentItem] = $l_aError;
        }
        
        return $this;
    }
    
    public function submit() {
        if (!empty($this->m_aError)) {
            throw new arrayException('invalid', 0, null, $this->m_aError);
        }
    }

}
