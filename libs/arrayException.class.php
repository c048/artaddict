<?php

    class arrayException extends Exception 
    {
        private $_resultArray;
        
        public function __construct($message, $code = 0, Exception $previous = null, $results = array('params')) {
            
            parent::__construct($message, $code, $previous);
            
            $this->_resultArray = $results;
            
        }
        
        public function getResults() {
            
            return $this->_resultArray;
            
        }
    }
