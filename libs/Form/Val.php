<?php

    class Val {
        
        function __construct() {
            
        }
        
        public function minLength($data, $arg) {
            if (strlen($data) < $arg) {
                return "The minimum required length is $arg characters";
            }
        }
        
        public function maxLength($data, $arg) {
            if (strlen($data) > $arg) {
                return "Your string can only be $arg long";
            }
        }
        
        public function digit($data) {
            if (!ctype_digit($data)) {
                return "Your string must be a digit";
            }
        }
        
        public function validFile($data) {
            $l_aAllowed = array('.jpg','.gif','.bmp','.png','.jpeg');
            $l_aExt = strtolower(substr($data, strrpos($data,'.')));
            
            if(empty($l_aExt)){
                return "You have not selected a file to upload";
            } else if (!in_array($l_aExt,$l_aAllowed)) {
                return "The file extension '$l_aExt' is not permitted";
            }
        }
        
        public function __call($name, $arguments) {
            throw new Exception("$name does not exist inside of: " . __CLASS__);
        }
    }