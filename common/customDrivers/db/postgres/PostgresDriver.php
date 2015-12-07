<?php

    include_once DB_COMMON_DIR.INSERT_OBJECT_OBJ;
    include_once DB_COMMON_DIR.SELECT_OBJECT_OBJ;
    include_once DB_COMMON_DIR.UPDATE_OBJECT_OBJ;
    include_once DB_COMMON_DIR.DELETE_OBJECT_OBJ;
    include_once DB_POSTGRES_DIR.POSTGRES_CONNECTION_OBJ;
    
    include_once UTILS_DIR.LOGGER_OBJ;
    
    class PostgresDriver {
        
        private $connection;
        private $isTransactionActive;
        
        function PostgresDriver($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass) {
             $this->connection = new PostgresConnection();
             $this->connection->connect($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass);
             $this->isTransactionActive = false;
        }
        
        
        public function performSelect(SelectObject $selectObj){
            // Procesamos el ordenamiento
            
            $orderByArray = array();
            $orderBy = " ";
            
            if(is_array($selectObj->getOrderBy()) && count($selectObj->getOrderBy()) > 0){
                foreach ($selectObj->getOrderBy() as $oby) {
                    $orderByArray[]= $oby . " ".$selectObj->getOrderPriority();
                }
                
                $orderBy .= "ORDER BY " . implode(",", $orderByArray);
            }
            
            $fr = $selectObj->getFirstResult();
            $nr = $selectObj->getNumResults();
            
            $out = "SELECT ".implode(",",$selectObj->getSelectedFields())." ";
            $out .= "FROM ".implode(",",$selectObj->getTables())." ";
            $out .= "WHERE ".$selectObj->getWhereSentence();
            $out .= $orderBy;
            
            if(is_numeric($fr) && is_numeric($nr)){
                $out .= " LIMIT ".$nr." OFFSET ".$fr;
            }
#echo "<br>******".$out;
			
			Logger::log($out,__FILE__,__CLASS__,__METHOD__,__LINE__);
            $res = $this->connection->performQuery($out);

            if(!$res){
                return null;
            }
            $res = pg_fetch_all($res);
            
            if(!$res){
                return null;
            }
            
            return $res;
        }
        
        public function countSelect(SelectObject $selectObj){
           
            
            $out = "SELECT COUNT(*) AS size ";
            $out .= "FROM ".implode(",",$selectObj->getTables())." ";
            $out .= "WHERE ".$selectObj->getWhereSentence();
#echo "<br>--------".$out;
        	
			Logger::log($out,__FILE__,__CLASS__,__METHOD__,__LINE__);
            $res = $this->connection->performQuery($out);

            if(!$res){
                return null;
            }
            $res = pg_fetch_all($res);
            
            if(!$res){
                return null;
            }
            
            return $res;
        }
        
        public function performDelete(DeleteObject $deleteObject){
            $out = "DELETE FROM ".$deleteObject->getTable()." ";
            $out .= "WHERE ".$deleteObject->getWhereSentence();
        	
			Logger::log($out,__FILE__,__CLASS__,__METHOD__,__LINE__);
            $res = $this->connection->performQuery($out);
            if(!$res){
                return false;
            }
                        
            return pg_affected_rows($res)>0;
        }
        
        public function beginTransaction(){
            $this->isTransactionActive = true;
        	
			Logger::log("beginTransaction",__FILE__,__CLASS__,__METHOD__,__LINE__);
            return $this->connection->beginTransaction();
        }
        
        public function commit(){
            $this->isTransactionActive = false;
        
			Logger::log("commit",__FILE__,__CLASS__,__METHOD__,__LINE__);
            return $this->connection->commit();
        }
        
        public function rollback(){
            $this->isTransactionActive = false;
        	
			Logger::log("rollback",__FILE__,__CLASS__,__METHOD__,__LINE__);
            return $this->connection->rollback();
        }
        
        public function performCustomQuery($query){
        	
			Logger::log($query,__FILE__,__CLASS__,__METHOD__,__LINE__);
            $res = $this->connection->performQuery($query);
            
            if(!$res){
                return null;
            }
            
            $res = pg_fetch_all($res);
            
            if(!$res){
                return null;
            }
            
            return $res;
        }
        
        public function performInsert(InsertObject $insertObj){
            $values = array();
            foreach ($insertObj->getValues() as $value){
                if($value === null){
                    $values [] = "NULL";
                }else{
                    $values [] = "'".$value."'";
                }
            }
            $out = "INSERT INTO ".$insertObj->getTable()." ";
            $out .= "( ".implode(",",$insertObj->getFields()).") ";
            $out .= "VALUES (".implode(",",$values).") ";
            $out .= "RETURNING ".$insertObj->getIdField();

        	
			Logger::log($out,__FILE__,__CLASS__,__METHOD__,__LINE__);
            $res = $this->connection->performQuery($out);
            
            if(!$res){
                return null;
            }
            
            $res = pg_fetch_all($res);
            
            return $res[0][$insertObj->getIdField()];
        }
        
        public function performUpdate(UpdateObject $updateObj){
            $fields = $updateObj->getFields();
            $values = $updateObj->getValues();
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
            $out = "UPDATE ".$updateObj->getTable()." ";
            $out .= "SET ".implode(",",$setQuery)." ";
            $out .= "WHERE ".$updateObj->getWhereSentence()." ";
            
        	
			Logger::log($out,__FILE__,__CLASS__,__METHOD__,__LINE__);
			
            $res = $this->connection->performQuery($out);
            if(!$res){
                return false;
            }
            
            return pg_affected_rows($res)>0;
        }
        
    	
    }
?>