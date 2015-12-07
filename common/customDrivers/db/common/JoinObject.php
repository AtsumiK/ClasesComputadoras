<?php


    class JoinObject {
    	public static $LEFT = " LEFT ";
    	public static $RIGHT = " RIGHT ";
    	public static $INNER = " INNER ";
    	public static $OUTER = " OUTER ";
    	public static $FULL = " FULL ";
    	
    	private static $JOIN = " JOIN ";
    	
        private $selectedFields;
        private $whereSentence;
        private $tables;
        private $firstResult;
        private $numResults;
        private $orderBy;
        private $orderPriority;
        private $joinType;
        
        function JoinObject($joinType, array $selectedFields, array $tables, $whereSentence = "TRUE", array $orderBy=null, $orderPriority = SQL_ASCENDING_ORDER, $firstResult = null, $numResults = null){
            $this->selectedFields = $selectedFields;
            $this->whereSentence = $whereSentence;
            $this->tables = $tables;
            $this->firstResult = $firstResult;
            $this->numResults = $numResults;
            $this->orderBy = $orderBy;
            $this->orderPriority = $orderPriority;
            $this->joinType = $joinType;
        }
        
        public function getSelectedFields(){
            return $this->selectedFields;
        }
        
        public function getWhereSentence(){
            return $this->whereSentence;
        }
        
        public function getTables(){
            return $this->tables;
        }
        
        public function getFirstResult(){
            return $this->firstResult;
        }
        
        public function getNumResults(){
            return $this->numResults;
        }
        
        public function getOrderBy(){
            return $this->orderBy;
        }
        
        public function getOrderPriority(){
            return $this->orderPriority;
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
         * Genera el código para PostgreSQL.
         * Esta versión sólo opera sobre 2 tablas.
         */
    	private function pgToString(){
    		$tables = $this->getTables();
    		
    		$out = " FROM ".$tables[0].$this->joinType.JoinObject::$JOIN.$tables[1]." ON (".$this->getWhereSentence().")";
            return $out;
        }
    }
?>