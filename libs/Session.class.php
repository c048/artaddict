<?php

class Session {
    
    public static function init() {
        @session_start();
    }

    public static function set($p_sKey, $p_sValue){
        $_SESSION[$p_sKey] = $p_sValue;
    }
    
    public static function get($p_sKey){
        if(isset($_SESSION[$p_sKey]))
            return $_SESSION[$p_sKey];
    }
    
    public static function destroy() {
        //unset session
        session_destroy();
    }
}