<?php


    class DeleteObject {
        private $table;
        private $whereSentence;
        
        function DeleteObject($table,$whereSentence = "TRUE") {
            $this->table = $table;
            $this->whereSentence = $whereSentence;
        }
        
        public function getTable(){
            return $this->table;
        }
        
        public function getWhereSentence(){
            return $this->whereSentence;
        }
        
    	/**
         * 
         * Convierte el objeto a string para enviar al motor de base de datos.
         * @param $dbEngine Constante que define el tipo de base de datos
         */
    	public function toString($dbEngine){
    		switch ($dbEngine) {
    			case DBConfigEnum::$POSTGRES_DB_TYPE:
    				return $this->pgToString();
    			break;
    			
    			default:
    				return $this->pgToString();
    			break;
    		}
    		
        }
        
        /**
         * 
         * SQL para PostgreSQL
         */
    	private function pgToString(){
    		$out = "DELETE FROM ".$this->getTable()." ";
            $out .= "WHERE ".$this->getWhereSentence();
            return $out;
        }
    }
?>