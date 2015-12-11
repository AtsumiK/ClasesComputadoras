<?php

    require_once SALAS_COMP_ENTITIES_DIR.PERSONA_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.RESPONSABLE_ENTITY;

    

    class ResponsableBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function ResponsableBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getResponsable(Responsable &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllResponsables($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllResponsables($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllResponsables(){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getResponsablesByResponsableFacultad($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_FACULTAD." LIKE '".$responsableFacultad."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableFacultad($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_FACULTAD." LIKE '".$responsableFacultad."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableFacultad($responsableFacultad){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESPONSABLE_FACULTAD." LIKE '".$responsableFacultad."'");

        }
        public function getResponsablesByResponsableAsignatura($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_ASIGNATURA." LIKE '".$responsableAsignatura."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableAsignatura($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_ASIGNATURA." LIKE '".$responsableAsignatura."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableAsignatura($responsableAsignatura){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESPONSABLE_ASIGNATURA." LIKE '".$responsableAsignatura."'");

        }
        public function getResponsablesByResponsablePersona(Persona $persona, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_PERSONA." = '".$persona->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsablePersona(Persona $persona, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_PERSONA." = '".$persona->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsablePersona(Persona $persona){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESPONSABLE_PERSONA." = '".$persona->getId()."'");
        }

        public function getResponsablesByResponsableFacultadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_FACULTAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableFacultadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_FACULTAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableFacultadBetween($firstValue, $secondValue){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->RESPONSABLE_FACULTAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_ASIGNATURA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_ASIGNATURA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->RESPONSABLE_ASIGNATURA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getResponsablesByResponsableFacultadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_FACULTAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableFacultadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_FACULTAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableFacultadBiggerThan($value){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESPONSABLE_FACULTAD." > '".$value."'");
        }

        public function getResponsablesByResponsableAsignaturaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_ASIGNATURA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableAsignaturaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_ASIGNATURA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableAsignaturaBiggerThan($value){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESPONSABLE_ASIGNATURA." > '".$value."'");
        }

        public function getResponsablesByResponsableFacultadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_FACULTAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableFacultadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_FACULTAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableFacultadLowerThan($value){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESPONSABLE_FACULTAD." < '".$value."'");
        }

        public function getResponsablesByResponsableAsignaturaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESPONSABLE_ASIGNATURA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listResponsablesByResponsableAsignaturaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Responsable();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESPONSABLE_ASIGNATURA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetResponsablesByResponsableAsignaturaLowerThan($value){
            $entity = new Responsable();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESPONSABLE_ASIGNATURA." < '".$value."'");
        }

        public function getResponsablesByResponsableFacultadBeginsWith($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getResponsablesByResponsableFacultad($responsableFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listResponsablesByResponsableFacultadBeginsWith($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listResponsablesByResponsableFacultad($responsableFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetResponsablesByResponsableFacultadBeginsWith($responsableFacultad, $firstResultNumber = null, $numResults = null){
            return $this->countGetResponsablesByResponsableFacultad($responsableFacultad . "%", $firstResultNumber, $numResults);
        }

        public function getResponsablesByResponsableFacultadEndsWith($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getResponsablesByResponsableFacultad("%" . $responsableFacultad, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listResponsablesByResponsableFacultadEndsWith($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listResponsablesByResponsableFacultad("%" . $responsableFacultad, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetResponsablesByResponsableFacultadEndsWith($responsableFacultad, $firstResultNumber = null, $numResults = null){
            return $this->countGetResponsablesByResponsableFacultad("%" . $responsableFacultad, $firstResultNumber, $numResults);
        }

        public function getResponsablesByResponsableFacultadContains($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getResponsablesByResponsableFacultad("%" . $responsableFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listResponsablesByResponsableFacultadContains($responsableFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listResponsablesByResponsableFacultad("%" . $responsableFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetResponsablesByResponsableFacultadContains($responsableFacultad){
            return $this->countGetResponsablesByResponsableFacultad("%" . $responsableFacultad . "%");
        }

        public function getResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getResponsablesByResponsableAsignatura($responsableAsignatura . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listResponsablesByResponsableAsignatura($responsableAsignatura . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura, $firstResultNumber = null, $numResults = null){
            return $this->countGetResponsablesByResponsableAsignatura($responsableAsignatura . "%", $firstResultNumber, $numResults);
        }

        public function getResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getResponsablesByResponsableAsignatura("%" . $responsableAsignatura, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listResponsablesByResponsableAsignatura("%" . $responsableAsignatura, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura, $firstResultNumber = null, $numResults = null){
            return $this->countGetResponsablesByResponsableAsignatura("%" . $responsableAsignatura, $firstResultNumber, $numResults);
        }

        public function getResponsablesByResponsableAsignaturaContains($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getResponsablesByResponsableAsignatura("%" . $responsableAsignatura . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listResponsablesByResponsableAsignaturaContains($responsableAsignatura, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listResponsablesByResponsableAsignatura("%" . $responsableAsignatura . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetResponsablesByResponsableAsignaturaContains($responsableAsignatura){
            return $this->countGetResponsablesByResponsableAsignatura("%" . $responsableAsignatura . "%");
        }

        public function updateResponsableFacultad(Responsable $entity,  $responsableFacultad){
            $entity->setResponsableFacultad($responsableFacultad);
            return $this->persistenceManager->update($entity);
        }

        public function updateResponsableAsignatura(Responsable $entity,  $responsableAsignatura){
            $entity->setResponsableAsignatura($responsableAsignatura);
            return $this->persistenceManager->update($entity);
        }

        public function updateResponsablePersona(Responsable $entity, Persona $responsablePersona){
            $entity->setResponsablePersona($responsablePersona->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setResponsable(Responsable &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setResponsables(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateResponsable(Responsable &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeResponsable(Responsable $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>