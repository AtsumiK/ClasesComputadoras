<?php

    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;

    

    class ComputadoraBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function ComputadoraBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getComputadora(Computadora &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllComputadoras($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllComputadoras($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllComputadoras(){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getComputadorasByComputadoraNombre($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_NOMBRE." LIKE '".$computadoraNombre."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraNombre($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_NOMBRE." LIKE '".$computadoraNombre."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraNombre($computadoraNombre){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_NOMBRE." LIKE '".$computadoraNombre."'");

        }
        public function getComputadorasByComputadoraRam($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_RAM." LIKE '".$computadoraRam."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraRam($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_RAM." LIKE '".$computadoraRam."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraRam($computadoraRam){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_RAM." LIKE '".$computadoraRam."'");

        }
        public function getComputadorasByComputadoraProcesador($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_PROCESADOR." LIKE '".$computadoraProcesador."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraProcesador($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_PROCESADOR." LIKE '".$computadoraProcesador."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraProcesador($computadoraProcesador){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_PROCESADOR." LIKE '".$computadoraProcesador."'");

        }
        public function getComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DISCO_DURO." LIKE '".$computadoraDiscoDuro."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DISCO_DURO." LIKE '".$computadoraDiscoDuro."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DISCO_DURO." LIKE '".$computadoraDiscoDuro."'");

        }
        public function getComputadorasByComputadoraDirIp($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_IP." LIKE '".$computadoraDirIp."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirIp($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_IP." LIKE '".$computadoraDirIp."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirIp($computadoraDirIp){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DIR_IP." LIKE '".$computadoraDirIp."'");

        }
        public function getComputadorasByComputadoraDirMac($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_MAC." LIKE '".$computadoraDirMac."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirMac($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_MAC." LIKE '".$computadoraDirMac."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirMac($computadoraDirMac){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DIR_MAC." LIKE '".$computadoraDirMac."'");

        }
        public function getComputadorasByObjetoEnInventario(ObjetoEnInventario $objetoEnInventario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAllFromRelationTables($entity, array($objetoEnInventario->ENTITY_DB_NAME), array($entity->ENTITY_DB_NAME.".*"), 
                 /*Where*/ $objetoEnInventario->ENTITY_DB_NAME.".".$objetoEnInventario->COMPUTADORA." = ".$entity->ENTITY_DB_NAME.".".$entity->PRIMARY_KEY_DB_NAME." AND ".$objetoEnInventario->ENTITY_DB_NAME.".".$objetoEnInventario->PRIMARY_KEY_DB_NAME."='".$objetoEnInventario->getId()."'",$orderBy , $orderPriority ,$firstResultNumber,$numResults);
        }

        public function listComputadorasByObjetoEnInventario(ObjetoEnInventario $objetoEnInventario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAllFromRelationTables($entity, array($objetoEnInventario->ENTITY_DB_NAME), $entity->getExplicitDbListFieldNamesWithPK(), 
                 /*Where*/ $objetoEnInventario->ENTITY_DB_NAME.".".$objetoEnInventario->COMPUTADORA." = ".$entity->ENTITY_DB_NAME.".".$entity->PRIMARY_KEY_DB_NAME." AND ".$objetoEnInventario->ENTITY_DB_NAME.".".$objetoEnInventario->PRIMARY_KEY_DB_NAME."='".$objetoEnInventario->getId()."'",$orderBy , $orderPriority ,$firstResultNumber,$numResults);
        }

        public function countGetComputadorasByObjetoEnInventario(ObjetoEnInventario $objetoEnInventario){
            $entity = new Computadora();
            return $this->persistenceManager->countAllFromRelationTables($entity, array($objetoEnInventario->ENTITY_DB_NAME), array(), 
                 /*Where*/ $objetoEnInventario->ENTITY_DB_NAME.".".$objetoEnInventario->COMPUTADORA." = ".$entity->ENTITY_DB_NAME.".".$entity->PRIMARY_KEY_DB_NAME." AND ".$objetoEnInventario->ENTITY_DB_NAME.".".$objetoEnInventario->PRIMARY_KEY_DB_NAME."='".$objetoEnInventario->getId()."'");
        }

        public function getComputadorasByComputadoraNombreBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraNombreBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraNombreBetween($firstValue, $secondValue){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMPUTADORA_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadorasByComputadoraRamBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_RAM." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraRamBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_RAM." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraRamBetween($firstValue, $secondValue){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMPUTADORA_RAM." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_PROCESADOR." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_PROCESADOR." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMPUTADORA_PROCESADOR." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DISCO_DURO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DISCO_DURO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMPUTADORA_DISCO_DURO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadorasByComputadoraDirIpBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_IP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirIpBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_IP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirIpBetween($firstValue, $secondValue){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMPUTADORA_DIR_IP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadorasByComputadoraDirMacBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_MAC." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirMacBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_MAC." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirMacBetween($firstValue, $secondValue){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMPUTADORA_DIR_MAC." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadorasByComputadoraNombreBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_NOMBRE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraNombreBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_NOMBRE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraNombreBiggerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_NOMBRE." > '".$value."'");
        }

        public function getComputadorasByComputadoraRamBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_RAM." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraRamBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_RAM." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraRamBiggerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_RAM." > '".$value."'");
        }

        public function getComputadorasByComputadoraProcesadorBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_PROCESADOR." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraProcesadorBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_PROCESADOR." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraProcesadorBiggerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_PROCESADOR." > '".$value."'");
        }

        public function getComputadorasByComputadoraDiscoDuroBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DISCO_DURO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDiscoDuroBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DISCO_DURO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDiscoDuroBiggerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DISCO_DURO." > '".$value."'");
        }

        public function getComputadorasByComputadoraDirIpBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_IP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirIpBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_IP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirIpBiggerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DIR_IP." > '".$value."'");
        }

        public function getComputadorasByComputadoraDirMacBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_MAC." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirMacBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_MAC." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirMacBiggerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DIR_MAC." > '".$value."'");
        }

        public function getComputadorasByComputadoraNombreLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_NOMBRE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraNombreLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_NOMBRE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraNombreLowerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_NOMBRE." < '".$value."'");
        }

        public function getComputadorasByComputadoraRamLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_RAM." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraRamLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_RAM." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraRamLowerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_RAM." < '".$value."'");
        }

        public function getComputadorasByComputadoraProcesadorLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_PROCESADOR." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraProcesadorLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_PROCESADOR." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraProcesadorLowerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_PROCESADOR." < '".$value."'");
        }

        public function getComputadorasByComputadoraDiscoDuroLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DISCO_DURO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDiscoDuroLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DISCO_DURO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDiscoDuroLowerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DISCO_DURO." < '".$value."'");
        }

        public function getComputadorasByComputadoraDirIpLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_IP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirIpLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_IP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirIpLowerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DIR_IP." < '".$value."'");
        }

        public function getComputadorasByComputadoraDirMacLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_DIR_MAC." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadorasByComputadoraDirMacLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Computadora();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_DIR_MAC." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadorasByComputadoraDirMacLowerThan($value){
            $entity = new Computadora();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_DIR_MAC." < '".$value."'");
        }

        public function getComputadorasByComputadoraNombreBeginsWith($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraNombre($computadoraNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraNombreBeginsWith($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraNombre($computadoraNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraNombreBeginsWith($computadoraNombre, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraNombre($computadoraNombre . "%", $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraNombreEndsWith($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraNombre("%" . $computadoraNombre, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraNombreEndsWith($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraNombre("%" . $computadoraNombre, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraNombreEndsWith($computadoraNombre, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraNombre("%" . $computadoraNombre, $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraNombreContains($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraNombre("%" . $computadoraNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraNombreContains($computadoraNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraNombre("%" . $computadoraNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraNombreContains($computadoraNombre){
            return $this->countGetComputadorasByComputadoraNombre("%" . $computadoraNombre . "%");
        }

        public function getComputadorasByComputadoraRamBeginsWith($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraRam($computadoraRam . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraRamBeginsWith($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraRam($computadoraRam . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraRamBeginsWith($computadoraRam, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraRam($computadoraRam . "%", $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraRamEndsWith($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraRam("%" . $computadoraRam, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraRamEndsWith($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraRam("%" . $computadoraRam, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraRamEndsWith($computadoraRam, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraRam("%" . $computadoraRam, $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraRamContains($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraRam("%" . $computadoraRam . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraRamContains($computadoraRam, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraRam("%" . $computadoraRam . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraRamContains($computadoraRam){
            return $this->countGetComputadorasByComputadoraRam("%" . $computadoraRam . "%");
        }

        public function getComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraProcesador($computadoraProcesador . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraProcesador($computadoraProcesador . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraProcesador($computadoraProcesador . "%", $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraProcesador("%" . $computadoraProcesador, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraProcesador("%" . $computadoraProcesador, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraProcesador("%" . $computadoraProcesador, $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraProcesadorContains($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraProcesador("%" . $computadoraProcesador . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraProcesadorContains($computadoraProcesador, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraProcesador("%" . $computadoraProcesador . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraProcesadorContains($computadoraProcesador){
            return $this->countGetComputadorasByComputadoraProcesador("%" . $computadoraProcesador . "%");
        }

        public function getComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro . "%", $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDiscoDuro("%" . $computadoraDiscoDuro, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDiscoDuro("%" . $computadoraDiscoDuro, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraDiscoDuro("%" . $computadoraDiscoDuro, $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDiscoDuro("%" . $computadoraDiscoDuro . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDiscoDuro("%" . $computadoraDiscoDuro . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro){
            return $this->countGetComputadorasByComputadoraDiscoDuro("%" . $computadoraDiscoDuro . "%");
        }

        public function getComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDirIp($computadoraDirIp . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDirIp($computadoraDirIp . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraDirIp($computadoraDirIp . "%", $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraDirIpEndsWith($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDirIp("%" . $computadoraDirIp, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDirIpEndsWith($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDirIp("%" . $computadoraDirIp, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDirIpEndsWith($computadoraDirIp, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraDirIp("%" . $computadoraDirIp, $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraDirIpContains($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDirIp("%" . $computadoraDirIp . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDirIpContains($computadoraDirIp, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDirIp("%" . $computadoraDirIp . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDirIpContains($computadoraDirIp){
            return $this->countGetComputadorasByComputadoraDirIp("%" . $computadoraDirIp . "%");
        }

        public function getComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDirMac($computadoraDirMac . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDirMac($computadoraDirMac . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraDirMac($computadoraDirMac . "%", $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraDirMacEndsWith($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDirMac("%" . $computadoraDirMac, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDirMacEndsWith($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDirMac("%" . $computadoraDirMac, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDirMacEndsWith($computadoraDirMac, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadorasByComputadoraDirMac("%" . $computadoraDirMac, $firstResultNumber, $numResults);
        }

        public function getComputadorasByComputadoraDirMacContains($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadorasByComputadoraDirMac("%" . $computadoraDirMac . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadorasByComputadoraDirMacContains($computadoraDirMac, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadorasByComputadoraDirMac("%" . $computadoraDirMac . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadorasByComputadoraDirMacContains($computadoraDirMac){
            return $this->countGetComputadorasByComputadoraDirMac("%" . $computadoraDirMac . "%");
        }

        public function updateComputadoraNombre(Computadora $entity,  $computadoraNombre){
            $entity->setComputadoraNombre($computadoraNombre);
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadoraRam(Computadora $entity,  $computadoraRam){
            $entity->setComputadoraRam($computadoraRam);
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadoraProcesador(Computadora $entity,  $computadoraProcesador){
            $entity->setComputadoraProcesador($computadoraProcesador);
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadoraDiscoDuro(Computadora $entity,  $computadoraDiscoDuro){
            $entity->setComputadoraDiscoDuro($computadoraDiscoDuro);
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadoraDirIp(Computadora $entity,  $computadoraDirIp){
            $entity->setComputadoraDirIp($computadoraDirIp);
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadoraDirMac(Computadora $entity,  $computadoraDirMac){
            $entity->setComputadoraDirMac($computadoraDirMac);
            return $this->persistenceManager->update($entity);
        }

        public function setComputadora(Computadora &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setComputadoras(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateComputadora(Computadora &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeComputadora(Computadora $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>