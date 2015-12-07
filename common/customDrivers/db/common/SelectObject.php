<?php


    class SelectObject {
        private $selectedFields;
        private $whereSentence;
        private $tables;
        private $firstResult;
        private $numResults;
        private $orderBy;
        private $orderPriority;
        private $joinObject;
        
        function SelectObject(array $selectedFields, array $tables, $whereSentence = "TRUE", array $orderBy=null, $orderPriority = SQL_ASCENDING_ORDER, $firstResult = null, $numResults = null, JoinObject $joinObject = null){
            $this->selectedFields = $selectedFields;
            $this->whereSentence = $whereSentence;
            $this->tables = $tables;
            $this->firstResult = $firstResult;
            $this->numResults = $numResults;
            $this->orderBy = $orderBy;
            $this->orderPriority = $orderPriority;
            $this->joinObject = $joinObject;
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
    	public function toString($dbEngine, $onlyCount = false){
    		switch ($dbEngine) {
    			case DBConfigEnum::$POSTGRES_DB_TYPE:
    				return $this->pgToString($dbEngine, $onlyCount);
    			break;
    			
    			default:
    				return $this->pgToString($dbEngine, $onlyCount);
    			break;
    		}
    		
        }
        
    	private function pgToString($dbEngine, $onlyCount = false){
    		$out = "";
    		if($onlyCount){
    			$out = "SELECT COUNT(*) AS size ";
	            if($this->joinObject == null){
		            $out .= "FROM ".implode(",",$this->getTables())." ";
	            	$out .= "WHERE ".$this->getWhereSentence();
	            }else{
	            	$out .= $this->joinObject->toString($dbEngine); 
	            }
	            
    		}else{
	    		// Procesamos el ordenamiento
	            
	            $orderByArray = array();
	            $orderBy = " ";
	            
	            if(is_array($this->getOrderBy()) && count($this->getOrderBy()) > 0){
	                foreach ($this->getOrderBy() as $oby) {
	                    $orderByArray[]= $oby . " ".$this->getOrderPriority();
	                }
	                
	                $orderBy .= "ORDER BY " . implode(",", $orderByArray);
	            }
	            
	            $fr = $this->getFirstResult();
	            $nr = $this->getNumResults();
	            
	            $out = "SELECT ".implode(",",$this->getSelectedFields())." ";
	            if($this->joinObject == null){
	            	$out .= "FROM ".implode(",",$this->getTables())." ";
	            }else{
	            	$out .= $this->joinObject->toString($dbEngine);
	            }
	            $out .= "WHERE ".$this->getWhereSentence();
	            $out .= $orderBy;
	            
	            if(is_numeric($fr) && is_numeric($nr)){
	                $out .= " LIMIT ".$nr." OFFSET ".$fr;
	            }
    		}
            return $out;
        }
    }
?>