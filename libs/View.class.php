<?php

class View {

    function __construct() {
    }

    public function render($p_sName, $p_bInclude = true) {
        if ($p_bInclude) {
            require 'views/' . $p_sName . '.php';
        }
    }
    
}