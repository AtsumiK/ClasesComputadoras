<?php
    class FileManager {

        /**
         * 
         * Retorna la extensión del archivo seleccionado. Si no tiene extensión, retorna null.
         * @param $name
         */
        public static function getFileType($name){
            $tmp = explode(".",$name);
            if(count($tmp)>1){
                return strtolower($tmp[(count($tmp)-1)]);
            }else{
                return null;
            }
        }
        
        /**
         * 
         * Retorna el nonbre de archivo a partir de una ruta de archivo completa.
         * @param unknown_type $file
         */
	    public static function getFileName($file){
	        $tmp = explode("/",$file);
	        if( count($tmp) > 1 ){
	            return $tmp[(count($tmp)-1)];
	        }else{
                return $file;
	        }
	    }
        
        
	    public static function writeLogFile($url, $textContent, $mode = "a"){
	    	$file = @fopen($url, $mode);
	    	if($file != null){
				@fwrite($file, $textContent);
				@fclose($file);
	    	} 
	    }
    }
?>