<?php

    include_once DB_DIR.DATABASE_DRIVER_OBJ;
    include_once DB_COMMON_DIR.DELETE_OBJECT_OBJ;
    include_once DB_COMMON_DIR.SELECT_OBJECT_OBJ;
    include_once DB_COMMON_DIR.UPDATE_OBJECT_OBJ;
    include_once DB_COMMON_DIR.INSERT_OBJECT_OBJ;
    include_once DB_COMMON_DIR.JOIN_OBJECT_OBJ;


    class PersistenceManager {


        private $dbDriver;

        function PersistenceManager($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass) {
             $this->dbDriver = new DataBaseDriver($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass);
        }

        /**
         * Carga un objeto de acuerdo con $dao dado su id.
         *
         * @param unknown_type $dao
         * @return retorna el objeto DAO con los datos cargados.
         */
        public function find(&$entity){

            $select = new SelectObject(array("*"),array($entity->ENTITY_DB_NAME),$entity->PRIMARY_KEY_DB_NAME."=".$entity->getId(),null,SQL_ASCENDING_ORDER,0,1);
            $res = $this->dbDriver->performSelect($select);
            if(!$res){
                return false;
            }

            $entity->loadFromSqlResultQuery($res[0]);
            return true;
        }

        /**
         * Carga un o varios objetos de acuerdo con el objeto $entity y la condici�n $where.
         *
         * @param $entity
         * @return retorna un array de objetos entity con los datos cargados.
         */
        public function findAll($entity, array $selectFields, $where = "TRUE", array $orderBy=null, $orderPriority = SQL_ASCENDING_ORDER, $firstResult = null, $numResults = null, JoinObject $joinObject = null ){
            $class = get_class($entity);
            $entities = array();
            $select = new SelectObject($selectFields,array($entity->ENTITY_DB_NAME),$where, $orderBy, $orderPriority, $firstResult, $numResults, $joinObject);
            $res = $this->dbDriver->performSelect($select);
            if(!$res){
                return $entities;
            }

            foreach($res as $rsEntity){
                $entityTmp = new $class();
                $entityTmp->loadFromSqlResultQuery($rsEntity);
                $entities[] = $entityTmp;
            }
            return $entities;
        }
    	/**
         * Carga un o varios objetos de acuerdo con el objeto $entity y la condici�n $where. Se tiene en cuenta en el select las entidades auxiliares $axuEntities
         *
         * @param $entity
         *
         * @return retorna un array de objetos entity con los datos cargados.
         */
        public function customFindAll($entity, array $axuEntities , array $selectFields, $where = "TRUE", array $orderBy=null, $orderPriority = SQL_ASCENDING_ORDER, $firstResult = null, $numResults = null, JoinObject $joinObject = null){
            $class = get_class($entity);
            $entities = array();
            $selectTables = array();
            $selectTables[] = $entity->ENTITY_DB_NAME;
            foreach ($axuEntities as $e) {
                $selectTables[] = $e->ENTITY_DB_NAME;
            }
            $select = new SelectObject($selectFields,$selectTables,$where, $orderBy, $orderPriority, $firstResult, $numResults, $joinObject);
            $res = $this->dbDriver->performSelect($select);
            if(!$res){
                return $entities;
            }

            foreach($res as $rsEntity){
                $entityTmp = new $class();
                $entityTmp->loadFromSqlResultQuery($rsEntity);
                $entities[] = $entityTmp;
            }
            return $entities;
        }


        public function findAllFromRelationTables($entity, array $relTables, array $selectFields, $where = "TRUE", array $orderBy=null, $orderPriority = SQL_ASCENDING_ORDER, $firstResult = null, $numResults = null, JoinObject $joinObject = null){
            $class = get_class($entity);
            $entities = array();
            $select = new SelectObject($selectFields, array_merge(array($entity->ENTITY_DB_NAME),$relTables),$where, $orderBy, $orderPriority, $firstResult, $numResults, $joinObject);
            $res = $this->dbDriver->performSelect($select);
            if(!$res){
                return $entities;
            }

            foreach($res as $rsEntity){
                $entityTmp = new $class();
                $entityTmp->loadFromSqlResultQuery($rsEntity);
                $entities[] = $entityTmp;
            }
            return $entities;
        }

        /**
         * Cuenta el número de elementos que resultarían de la consulta.
         *
         * @param  $entity
         * @param array $selectFields
         * @param  $where
         * @param  $firstResult
         * @param  $numResults
         * @return unknown
         */
        public function countAll($entity, array $selectFields, $where = "TRUE", JoinObject $joinObject = null){
            $class = get_class($entity);
            $entities = array();
            $select = new SelectObject($selectFields,array($entity->ENTITY_DB_NAME),$where, $joinObject);
            $res = $this->dbDriver->countSelect($select);
            if(!$res){
                return 0;
            }

            return $res[0]['size'];
        }

        /**
         * Cuenta el número de elementos que resultarían de la consulta.
         *
         * @param  $entity
         * @param array $selectFields
         * @param  $where
         * @param  $firstResult
         * @param  $numResults
         * @return unknown
         */
        public function customCountAll($entity, array $axuEntities , array $selectFields, $where = "TRUE", JoinObject $joinObject = null){
            $class = get_class($entity);
            $entities = array();
            $selectTables = array();
            $selectTables[] = $entity->ENTITY_DB_NAME;
            foreach ($axuEntities as $e) {
                $selectTables[] = $e->ENTITY_DB_NAME;
            }
            $select = new SelectObject($selectFields,$selectTables,$where, $joinObject);
            $res = $this->dbDriver->countSelect($select);
            if(!$res){
                return 0;
            }

            return $res[0]['size'];
        }

        public function countAllFromRelationTables($entity, array $relTables, array $selectFields, $where = "TRUE"){
            $class = get_class($entity);
            $entities = array();
            $select = new SelectObject($selectFields,array_merge(array($entity->ENTITY_DB_NAME),$relTables),$where);
            $res = $this->dbDriver->countSelect($select);
            if(!$res){
                return 0;
            }

            return $res[0]['size'];
        }

        /**
         * Guarda una entidad dependiendo el $entity. Actualiza el entity con el nuevo id.
         *
         * @param $entity
         * @return true o false dependiendo el �xito de la operaci�n.
         */
        public function save(&$entity){
            $insert = new InsertObject($entity->ENTITY_DB_NAME,$entity->getDbFieldNames(),$entity->getDbFieldValues(),$entity->PRIMARY_KEY_DB_NAME);
            $res = $this->dbDriver->performInsert($insert);
            if($res === null){
                return false;
            }
            $entity->setId($res);
            return true;
        }

    	/**
    	 * Guarda una entrada nueva en una tabla de relación.
    	 *
    	 * @param unknown_type $relTableName
    	 * @param unknown_type $relTableKeyName
    	 * @param array $fieldNames
    	 * @param array $values
    	 * @return unknown
    	 */
        public function addItemToRelationTable($relTableName, $relTableKeyName,array $fieldNames, array $values){
            $insert = new InsertObject($relTableName,$fieldNames,$values, $relTableKeyName);
            $res = $this->dbDriver->performInsert($insert);
            if($res === null){
                return false;
            }
            return true;
        }
    	/**
         * Guarda una o m�s entidades dependiendo el arreglo de entitys. Actualiza de los entitys con el nuevo id.
         *
         * @param $entity
         * @return true o false dependiendo el �xito de la operaci�n.
         */
        public function saveAll(array &$entities){
            foreach($entities as $entity){
                $insert = new InsertObject($entity->ENTITY_DB_NAME,$entity->getDbFieldNames(),$entity->getDbFieldValues(),$entity->PRIMARY_KEY_DB_NAME);
                $res = $this->dbDriver->performInsert($insert);
                if($res === null){
                    return false;
                }
                $entity->setId($res);
            }
            return true;
        }

        /**
         * Actualiza una entidad.
         *
         * @param  $entity
         * @return true o false dependiendo el �xito de la operaci�n.
         */
        public function update($entity){

            $update = new UpdateObject($entity->ENTITY_DB_NAME,$entity->getDbFieldNames(),$entity->getDbFieldValues(),$entity->PRIMARY_KEY_DB_NAME."=".$entity->getId());

            $res = $this->dbDriver->performUpdate($update);

            return $res;
        }

    	/**
         * Actualiza una o m�s entidades.
         *
         * @param  $entity
         * @return true o false dependiendo el �xito de la operaci�n.
         */
        public function updateAll(array &$entities){
            foreach($entities as $entity){
                $update = new UpdateObject($entity->ENTITY_DB_NAME,$entity->getDbFieldNames(),$entity->getDbFieldValues(),$entity->PRIMARY_KEY_DB_NAME."=".$entity->getId());
                $res = $this->dbDriver->performUpdate($update);
                if(!$res){
                    return $res;
                }
            }

            return $res;
        }

        /**
         * Elimina una entidad de acuerdo con el entity indicado.
         *
         * @param  $entity
         * @return true o false dependiendo el �xito de la operaci�n.
         */
        public function remove($entity){
            $remove = new DeleteObject($entity->ENTITY_DB_NAME,$entity->PRIMARY_KEY_DB_NAME."=".$entity->getId());
            $res = $this->dbDriver->performDelete($remove);

            return $res;
        }

    	/**
    	 * Elimina una entrada en una tabla de relación.
    	 *
    	 * @param  $relTableName
    	 * @param  $relTableKeyName
    	 * @param array $fieldNames
    	 * @param array $values
    	 * @return boolean
    	 */
        public function dropItemFromRelationTable($relTableName, array $fieldNames, array $values){
            $where = array();

            for ($i = 0 ; $i<count($fieldNames) ; $i++){
                $where[] = $fieldNames[$i] ."=". $values[$i];
            }

            $remove = new DeleteObject($relTableName,implode(" AND ",$where));
            $res = $this->dbDriver->performDelete($remove);

            return $res;
        }

    	/**
         * Elimina una o mas entidades de acuerdo con los entities indicados.
         *
         * @param  $entities
         * @return true o false dependiendo el �xito de la operaci�n.
         */
        public function removeAll(array &$entities){
            foreach($entities as $entity){
                $remove = new DeleteObject($entity->ENTITY_DB_NAME,$entity->PRIMARY_KEY_DB_NAME."=".$entity->getId());
                $res = $this->dbDriver->performDelete($remove);
                if(!$res){
                    return $res;
                }
            }
            return $res;
        }

        public function performCustomQuery($query){
            $res = $this->dbDriver->performCustomQuery($query);
            return $res;
        }

        public function beginTransaction(){
            return $this->dbDriver->beginTransaction();
        }

        public function commitTransaction(){
            return $this->dbDriver->commit();
        }

        public function rollbackTransaction(){
            return $this->dbDriver->rollback();
        }


    }
?>
