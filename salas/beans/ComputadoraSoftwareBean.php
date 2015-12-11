<?php

    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_SOFTWARE_ENTITY;

    

    class ComputadoraSoftwareBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function ComputadoraSoftwareBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getComputadoraSoftware(ComputadoraSoftware &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllComputadoraSoftwares($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllComputadoraSoftwares($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllComputadoraSoftwares(){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA." LIKE '".$numeroSeriePrograma."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA." LIKE '".$numeroSeriePrograma."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->NUMERO_SERIE_PROGRAMA." LIKE '".$numeroSeriePrograma."'");

        }
        public function getComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION." LIKE '".$compSoftFechaInstalacion."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION." LIKE '".$compSoftFechaInstalacion."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMP_SOFT_FECHA_INSTALACION." LIKE '".$compSoftFechaInstalacion."'");

        }
        public function getComputadoraSoftwaresByComputadora(Computadora $computadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA." = '".$computadora->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByComputadora(Computadora $computadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA." = '".$computadora->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByComputadora(Computadora $computadora){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA." = '".$computadora->getId()."'");
        }

        public function getComputadoraSoftwaresBySoftware(Software $software, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE." = '".$software->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresBySoftware(Software $software, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE." = '".$software->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresBySoftware(Software $software){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE." = '".$software->getId()."'");
        }

        public function getComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->NUMERO_SERIE_PROGRAMA." > '".$value."'");
        }

        public function getComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMP_SOFT_FECHA_INSTALACION." > '".$value."'");
        }

        public function getComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->NUMERO_SERIE_PROGRAMA." < '".$value."'");
        }

        public function getComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value){
            $entity = new ComputadoraSoftware();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMP_SOFT_FECHA_INSTALACION." < '".$value."'");
        }

        public function getComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma . "%", $firstResultNumber, $numResults);
        }

        public function getComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadoraSoftwaresByNumeroSeriePrograma("%" . $numeroSeriePrograma, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadoraSoftwaresByNumeroSeriePrograma("%" . $numeroSeriePrograma, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadoraSoftwaresByNumeroSeriePrograma("%" . $numeroSeriePrograma, $firstResultNumber, $numResults);
        }

        public function getComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadoraSoftwaresByNumeroSeriePrograma("%" . $numeroSeriePrograma . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadoraSoftwaresByNumeroSeriePrograma("%" . $numeroSeriePrograma . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma){
            return $this->countGetComputadoraSoftwaresByNumeroSeriePrograma("%" . $numeroSeriePrograma . "%");
        }

        public function getComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion . "%", $firstResultNumber, $numResults);
        }

        public function getComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadoraSoftwaresByCompSoftFechaInstalacion("%" . $compSoftFechaInstalacion, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadoraSoftwaresByCompSoftFechaInstalacion("%" . $compSoftFechaInstalacion, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null){
            return $this->countGetComputadoraSoftwaresByCompSoftFechaInstalacion("%" . $compSoftFechaInstalacion, $firstResultNumber, $numResults);
        }

        public function getComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getComputadoraSoftwaresByCompSoftFechaInstalacion("%" . $compSoftFechaInstalacion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listComputadoraSoftwaresByCompSoftFechaInstalacion("%" . $compSoftFechaInstalacion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion){
            return $this->countGetComputadoraSoftwaresByCompSoftFechaInstalacion("%" . $compSoftFechaInstalacion . "%");
        }

        public function updateNumeroSeriePrograma(ComputadoraSoftware $entity,  $numeroSeriePrograma){
            $entity->setNumeroSeriePrograma($numeroSeriePrograma);
            return $this->persistenceManager->update($entity);
        }

        public function updateCompSoftFechaInstalacion(ComputadoraSoftware $entity,  $compSoftFechaInstalacion){
            $entity->setCompSoftFechaInstalacion($compSoftFechaInstalacion);
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadora(ComputadoraSoftware $entity, Computadora $computadora){
            $entity->setComputadora($computadora->getId());
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftware(ComputadoraSoftware $entity, Software $software){
            $entity->setSoftware($software->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setComputadoraSoftware(ComputadoraSoftware &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setComputadoraSoftwares(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateComputadoraSoftware(ComputadoraSoftware &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeComputadoraSoftware(ComputadoraSoftware $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>