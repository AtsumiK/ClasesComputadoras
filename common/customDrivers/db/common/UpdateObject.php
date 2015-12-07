<?php


    class UpdateObject {
        private $fields;
        private $values;
        private $table;
        private $whereSentence;
        
        function UpdateObject($table, array $fields, array $values, $whereSentence = "TRUE") {
            $this->table = $table;
            $this->fields = $fields;
            $this->values = $values;
            $this->whereSentence = $whereSentence;
        }
        
        public function getTable(){
            return $this->table;
        }
        
        public function getFields(){
            return $this->fields;
        }
        
        public function getValues(){
            return $this->values;
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
    		
            $fields = $this->getFields();
            $values = $this->getValues();
            if(count($fields) != count($values)){
                return false;
            }
            
            $setQuery = array();
            for ($i = 0 ; $i < count($fields) ; $i++){
                
                if($values[$i] === null){
                    $setQuery[] = ($fields[$i]."=NULL ");
                }else{
                    $setQuery[] = ($fields[$i]."='".$values[$i]."' ");
                }
            }
            $out = "UPDATE ".$this->getTable()." ";
            $out .= "SET ".implode(",",$setQuery)." ";
            $out .= "WHERE ".$this->getWhereSentence()." ";
            
            return $out;
        }
    }
?>