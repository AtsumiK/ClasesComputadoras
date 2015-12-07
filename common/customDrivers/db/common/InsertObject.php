<?php


    class InsertObject {
        private $fields;
        private $values;
        private $table;
        private $idField;
        
        function InsertObject($table, array $fields, array $values, $idField ) {
            $this->table = $table;
            $this->fields = $fields;
            $this->values = $values;
            $this->idField = $idField;
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
    
        public function getIdField(){
            return $this->idField;
        }
        
    /**
         * 
         * Convierte el objeto a string para enviar al motor de base de datos.
         * @param $dbEngine Constante que define el tipo de base de datos
         * @param $onlyCount true si sólo realizará la cuenta de cuántos elementos tiene el select, false para retornar todos los elementos
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
    		$values = array();
            foreach ($this->getValues() as $value){
                if($value === null){
                    $values [] = "NULL";
                }else{
                    $values [] = "'".$value."'";
                }
            }
            $out = "INSERT INTO ".$this->getTable()." ";
            $out .= "( ".implode(",",$this->getFields()).") ";
            $out .= "VALUES (".implode(",",$values).") ";
            $out .= "RETURNING ".$this->getIdField();
            return $out;
        }
    }
?>