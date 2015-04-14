<?php

    abstract class Controller {

    public function __construct() {
        $this->view = new View();
    }
    
    /**
     * 
     * @param string $p_sName Name of the model
     * @param string $p_sPath Location of the models
     */
    public function loadModel($p_sName, $p_sModelPath = 'models/') {
        $l_sFilePath = $p_sModelPath . $p_sName . '_model.php';
        
        if (file_exists($l_sFilePath)) {
            require $p_sModelPath . $p_sName . '_model.php';
            $l_sModelName = $p_sName.'_Model';
            $this->model = new $l_sModelName;
        }
    }

}
