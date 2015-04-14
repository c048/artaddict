<?php

class Database extends PDO
{
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
        
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }
    
    /**
     * @param string $p_sSql An SQL string
     * @param array $p_aParams Parameters to bind
     * @param constant $p_cFetchMode A PDO fetchmode
     * @return mixed
     */
    public function select($p_sSql, $p_aParams = array(), $p_cFetchMode = PDO::FETCH_ASSOC) {
        $l_oSth = $this->prepare($p_sSql);
        
        foreach($p_aParams as $key => $value) {
            if(isset($value['type'])){
                $l_oSth->bindValue(":$key", $value['val'], PDO::PARAM_INT);
            } else {
                $l_oSth->bindValue(":$key", $value);
            }
        }
        
        $l_oSth->execute();
        return $l_oSth->fetchAll($p_cFetchMode);
    }
    
    public function insert($p_aTable, $p_aData) {
        ksort($p_aData);
        
        $l_sFieldNames = NULL;
        $l_sFieldValues = NULL;
        
        $l_sFieldNames = implode(', ', array_keys($p_aData));
        $l_sFieldValues = ':' . implode(', :', array_keys($p_aData));
        
        $l_oSth = $this->prepare("INSERT INTO $p_aTable ($l_sFieldNames) VALUES ($l_sFieldValues)");
        
        foreach ($p_aData as $key => $value) {
            $l_oSth->bindValue(":$key", $value);
        }
        
        $l_oSth->execute();
    }
    
    public function update($p_aTable, $p_aData, $p_sWhere) {
        ksort($p_aData);
        
        $l_sFieldDetails = NULL;
        
        foreach ($p_aData as $key => $value) {
            $l_sFieldDetails .= "$key =:$key,";
        }
        $l_sFieldDetails = rtrim($l_sFieldDetails, ',');
        
        $l_oSth = $this->prepare("UPDATE $p_aTable SET $l_sFieldDetails WHERE $p_sWhere");
        
        foreach ($p_aData as $key => $value) {
            $l_oSth->bindValue(":$key", $value);
        }
        
        $l_oSth->execute();
    }
    
    /**
     * @param string $p_aTable
     * @param string $p_sWhere
     * @param integer $p_nLimit
     * @return integer Affected rows
     */
    public function delete($p_aTable, $p_sWhere, $p_nLimit = 1) {
        return $this->exec("DELETE FROM $p_aTable WHERE $p_sWhere LIMIT $p_nLimit");
    }
}