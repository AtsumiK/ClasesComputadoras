<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataBaseConfig
 *
 * @author Oskitar
 */
include_once DB_DIR.DB_CONFIG_ENUM_OBJ;

class DataBaseConfig {

   
    public $DB_TYPE;
    
    function DataBaseConfig($dbType){
        switch($dbType){ 
            case DBConfigEnum::$POSTGRES_DB_TYPE:
                $this->DB_TYPE = DBConfigEnum::$POSTGRES_DB_TYPE;
                break;
            default:
                $this->DB_TYPE = DBConfigEnum::$POSTGRES_DB_TYPE;
                break;
        }
    }
    
}
?>