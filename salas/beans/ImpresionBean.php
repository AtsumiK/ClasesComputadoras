<?php

    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.IMPRESION_ENTITY;

    

    class ImpresionBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function ImpresionBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getImpresion(Impresion &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllImpresions($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllImpresions($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllImpresions(){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getImpresionsByImpresionFecha($impresionFecha, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_FECHA." LIKE '".$impresionFecha."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionFecha($impresionFecha, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_FECHA." LIKE '".$impresionFecha."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionFecha($impresionFecha){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), $entity->IMPRESION_FECHA." LIKE '".$impresionFecha."'");

        }
        public function getImpresionsByImpresionLugar($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_LUGAR." LIKE '".$impresionLugar."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionLugar($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_LUGAR." LIKE '".$impresionLugar."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionLugar($impresionLugar){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), $entity->IMPRESION_LUGAR." LIKE '".$impresionLugar."'");

        }
        public function getImpresionsByImpresionEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_ESTUDIANTE." = '".$estudiante->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_ESTUDIANTE." = '".$estudiante->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionEstudiante(Estudiante $estudiante){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), $entity->IMPRESION_ESTUDIANTE." = '".$estudiante->getId()."'");
        }

        public function getImpresionsByImpresionFechaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_FECHA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionFechaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_FECHA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionFechaBetween($firstValue, $secondValue){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->IMPRESION_FECHA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getImpresionsByImpresionLugarBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_LUGAR." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionLugarBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_LUGAR." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionLugarBetween($firstValue, $secondValue){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->IMPRESION_LUGAR." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getImpresionsByImpresionFechaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_FECHA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionFechaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_FECHA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionFechaBiggerThan($value){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), $entity->IMPRESION_FECHA." > '".$value."'");
        }

        public function getImpresionsByImpresionLugarBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_LUGAR." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionLugarBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_LUGAR." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionLugarBiggerThan($value){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), $entity->IMPRESION_LUGAR." > '".$value."'");
        }

        public function getImpresionsByImpresionFechaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_FECHA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionFechaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_FECHA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionFechaLowerThan($value){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), $entity->IMPRESION_FECHA." < '".$value."'");
        }

        public function getImpresionsByImpresionLugarLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->IMPRESION_LUGAR." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listImpresionsByImpresionLugarLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Impresion();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->IMPRESION_LUGAR." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetImpresionsByImpresionLugarLowerThan($value){
            $entity = new Impresion();
            return $this->persistenceManager->countAll($entity, array(), $entity->IMPRESION_LUGAR." < '".$value."'");
        }

        public function getImpresionsByImpresionLugarBeginsWith($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getImpresionsByImpresionLugar($impresionLugar . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listImpresionsByImpresionLugarBeginsWith($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listImpresionsByImpresionLugar($impresionLugar . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetImpresionsByImpresionLugarBeginsWith($impresionLugar, $firstResultNumber = null, $numResults = null){
            return $this->countGetImpresionsByImpresionLugar($impresionLugar . "%", $firstResultNumber, $numResults);
        }

        public function getImpresionsByImpresionLugarEndsWith($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getImpresionsByImpresionLugar("%" . $impresionLugar, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listImpresionsByImpresionLugarEndsWith($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listImpresionsByImpresionLugar("%" . $impresionLugar, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetImpresionsByImpresionLugarEndsWith($impresionLugar, $firstResultNumber = null, $numResults = null){
            return $this->countGetImpresionsByImpresionLugar("%" . $impresionLugar, $firstResultNumber, $numResults);
        }

        public function getImpresionsByImpresionLugarContains($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getImpresionsByImpresionLugar("%" . $impresionLugar . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listImpresionsByImpresionLugarContains($impresionLugar, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listImpresionsByImpresionLugar("%" . $impresionLugar . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetImpresionsByImpresionLugarContains($impresionLugar){
            return $this->countGetImpresionsByImpresionLugar("%" . $impresionLugar . "%");
        }

        public function updateImpresionFecha(Impresion $entity,  $impresionFecha){
            $entity->setImpresionFecha($impresionFecha);
            return $this->persistenceManager->update($entity);
        }

        public function updateImpresionLugar(Impresion $entity,  $impresionLugar){
            $entity->setImpresionLugar($impresionLugar);
            return $this->persistenceManager->update($entity);
        }

        public function updateImpresionEstudiante(Impresion $entity, Estudiante $impresionEstudiante){
            $entity->setImpresionEstudiante($impresionEstudiante->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setImpresion(Impresion &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setImpresions(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateImpresion(Impresion &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeImpresion(Impresion $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>