<?php

    
    include_once DB_DIR.DATABASE_CONFIG_OBJ;
    include_once DB_CONFIG_ENUM_OBJ;
    include_once DB_COMMON_DIR.INSERT_OBJECT_OBJ;
    include_once DB_COMMON_DIR.SELECT_OBJECT_OBJ;
    include_once DB_COMMON_DIR.UPDATE_OBJECT_OBJ;
    include_once DB_COMMON_DIR.DELETE_OBJECT_OBJ;
    include_once DB_POSTGRES_DIR.POSTGRES_DRIVER_OBJ;
    

    class DataBaseDriver {
        
        private $dbConfig;
        private $dbDriver;
        
        function DataBaseDriver($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass) {
            $this->dbConfig = new DataBaseConfig(DBConfigEnum::$POSTGRES_DB_TYPE);
            switch ($this->dbConfig->DB_TYPE){
                case DBConfigEnum::$POSTGRES_DB_TYPE:
                    $this->dbDriver = new PostgresDriver($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass);
                    break;
                default:
                    $this->dbDriver = new PostgresDriver($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass);
                    break;
            }
        }
        
        public function performSelect(SelectObject $selectObject){
            return $this->dbDriver->performSelect($selectObject);
        }
        
        public function countSelect(SelectObject $selectObject){
            return $this->dbDriver->countSelect($selectObject);
        }
        
        public function performInsert(InsertObject $insertObject){
            return $this->dbDriver->performInsert($insertObject);
        }
        
        public function performUpdate(UpdateObject $updateObject){
            return $this->dbDriver->performUpdate($updateObject);
        }
        
        public function performDelete(DeleteObject $deleteObject){
            return $this->dbDriver->performDelete($deleteObject);
        }
        
        public function beginTransaction(){
            return $this->dbDriver->beginTransaction();
        }
        
        public function commit(){
            return $this->dbDriver->commit();
        }
        
        public function rollback(){
            return $this->dbDriver->rollback();
        }
        
        public function performCustomQuery($query){
            return $this->dbDriver->performCustomQuery($query);
        }
    }
?>
