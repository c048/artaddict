<?php

class Hash
{
    /**
     * 
     * @param string $p_sAlgo The algorithm (md5, sha1, whirlpool, etc)
     * @param string $p_sData The data to encode
     * @param string $p_sSalt The salt (This should be the same throughout the system)
     * @return string The hashed/salt data
     */
    public static function create($p_sAlgo, $p_sData, $p_sSalt) {
        
        $l_sContext = hash_init($p_sAlgo, HASH_HMAC, $p_sSalt);
        hash_update($l_sContext, $p_sData);
        
        return hash_final($l_sContext);
    }
    
}