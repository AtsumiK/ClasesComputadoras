<?php

    include_once UTILS_DIR.HC_FILE_MANAGER_OBJ;
    
    
    class Logger {
        
    	/**
    	 * 
    	 * Registra un log en una rchivo plano y sin verificar éxito.
    	 * @param $textContent - Contenido textual para log.
    	 * @param $layer - capa del sistema. Ej: "bean", "controller", "db"...
    	 * @param $domainID
    	 */
        public static function log($textContent, $file, $class, $method, $line){
        	if(LOG_ENABLED){
        		FileManager::writeLogFile(LOG_DIR."HC.log", "****************************************\r\nFile: ".$file."\r\nClass: ".$class."\r\nMethod: ".$method."\r\nLine: ".$line."\r\n----- SQL -----\r\n".$textContent."\r\n\r\n\r\n");
        	}
        }
        
    }
?>