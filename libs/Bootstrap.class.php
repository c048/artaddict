<?php

class Bootstrap {

    private $m_aUrl = null;
    private $m_aController;
    
    private $m_sControllerPath = 'controllers/';
    private $m_sModelPath = 'models/';
    private $m_sErrorFile = 'error_controller.php';
    private $m_sDefaultFile = 'index_controller.php';
    
    /**
     * Starts the Bootstrap
     * 
     * @return boolean|string
     */
    public function init() {
        //Sets the protected $m_aUrl
        $this->_getUrl();
   
        // Load the default controller if no URL is set
        if(empty($this->m_aUrl[0])){
            $this->_loadDefaultController();
            $this->_callControllerMethod();
        } else {
            $this->_loadExistingController();
            $this->_callControllerMethod();
        }
    }
    
    /**
     * (Optional) Set a custom path to controllers
     * @param string $path
     */
    public function setControllerPath($path) {
        $this->m_sControllerPath = trim($path, '/') . '/';
    }
    
    /**
     * (Optional) Set a custom path to models
     * @param string $path
     */
    public function setModelPath($path) {
        $this->m_sModelPath = trim($path, '/') . '/';
    }
    
    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name only of your controller, eg: error.php
     */
    public function setErrorFile($path) {
        $this->m_sErrorFile = trim($path, '/');
    }
    
    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name only of your controller, eg: index.php
     */
    public function setDefaultFile($path) {
        $this->m_sDefaultFile = trim($path, '/');
    }

    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl() {
        $l_sUrl = isset($_GET['url']) ? $_GET['url'] : null;
        $l_sUrl = rtrim($l_sUrl, '/');
        $l_sUrl = filter_var($l_sUrl, FILTER_SANITIZE_URL);
        $this->m_aUrl = explode('/', $l_sUrl);
    }
    
    /**
     * Loads if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->m_sControllerPath . $this->m_sDefaultFile;
        $this->m_aController = new Index();
        $this->m_aController->loadModel('index', $this->m_sModelPath);
    }
    
    /**
     * Load an existing controller if a GET parameter is passed
     * 
     * @return boolean|string
     */
    private function _loadExistingController() {
        $l_sFilePath = $this->m_sControllerPath . $this->m_aUrl[0] . '_controller.php';
        
        if(file_exists($l_sFilePath)) {
            require $l_sFilePath;
            $this->m_aController = new $this->m_aUrl[0];
            $this->m_aController->loadModel($this->m_aUrl[0], $this->m_sModelPath);
        } else {
            $this->_error();
            return false;
        }
    }
    
    /**
     * If a method is passed in the GET url parameter
     */
    private function _callControllerMethod() {
        $l_nLength = count($this->m_aUrl);
        
        // Make sure the method we are calling exists
        if ($l_nLength > 1) {
            if (!method_exists($this->m_aController, $this->m_aUrl[1])) {
                $this->_error();
            }
        }
        
        switch ($l_nLength) {
            case 5:
                $this->m_aController->{$this->m_aUrl[1]}($this->m_aUrl[2], $this->m_aUrl[3], $this->m_aUrl[4]);
                break;
            
            case 4:
                $this->m_aController->{$this->m_aUrl[1]}($this->m_aUrl[2], $this->m_aUrl[3]);
                break;
            
            case 3:
                $this->m_aController->{$this->m_aUrl[1]}($this->m_aUrl[2]);
                break;
            
            case 2:
                $this->m_aController->{$this->m_aUrl[1]}();
                break;

            default:
                $this->m_aController->index();
                break;
        }
    }
    
    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    public function _error() {
        require $this->m_sControllerPath . $this->m_sErrorFile;
        $this->m_aController = new Error();
        $this->m_aController->index();
        exit;
    }
}
