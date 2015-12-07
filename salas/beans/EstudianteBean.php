<?php

    require_once SALAS_COMP_ENTITIES_DIR.PERSONA_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;

    

    class EstudianteBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function EstudianteBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getEstudiante(Estudiante &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllEstudiantes($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllEstudiantes($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllEstudiantes(){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getEstudiantesByEstudianteCodigo($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CODIGO." LIKE '".$estudianteCodigo."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCodigo($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CODIGO." LIKE '".$estudianteCodigo."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCodigo($estudianteCodigo){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_CODIGO." LIKE '".$estudianteCodigo."'");

        }
        public function getEstudiantesByEstudianteFacultad($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_FACULTAD." LIKE '".$estudianteFacultad."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteFacultad($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_FACULTAD." LIKE '".$estudianteFacultad."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteFacultad($estudianteFacultad){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_FACULTAD." LIKE '".$estudianteFacultad."'");

        }
        public function getEstudiantesByEstudianteCarrerra($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CARRERRA." LIKE '".$estudianteCarrerra."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCarrerra($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CARRERRA." LIKE '".$estudianteCarrerra."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCarrerra($estudianteCarrerra){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_CARRERRA." LIKE '".$estudianteCarrerra."'");

        }
        public function getEstudiantesByEstudiantePersona(Persona $persona, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_PERSONA." = '".$persona->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudiantePersona(Persona $persona, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_PERSONA." = '".$persona->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudiantePersona(Persona $persona){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_PERSONA." = '".$persona->getId()."'");
        }

        public function getEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CODIGO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CODIGO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->ESTUDIANTE_CODIGO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_FACULTAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_FACULTAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->ESTUDIANTE_FACULTAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CARRERRA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CARRERRA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->ESTUDIANTE_CARRERRA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getEstudiantesByEstudianteCodigoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CODIGO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCodigoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CODIGO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCodigoBiggerThan($value){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_CODIGO." > '".$value."'");
        }

        public function getEstudiantesByEstudianteFacultadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_FACULTAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteFacultadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_FACULTAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteFacultadBiggerThan($value){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_FACULTAD." > '".$value."'");
        }

        public function getEstudiantesByEstudianteCarrerraBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CARRERRA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCarrerraBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CARRERRA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCarrerraBiggerThan($value){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_CARRERRA." > '".$value."'");
        }

        public function getEstudiantesByEstudianteCodigoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CODIGO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCodigoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CODIGO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCodigoLowerThan($value){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_CODIGO." < '".$value."'");
        }

        public function getEstudiantesByEstudianteFacultadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_FACULTAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteFacultadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_FACULTAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteFacultadLowerThan($value){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_FACULTAD." < '".$value."'");
        }

        public function getEstudiantesByEstudianteCarrerraLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ESTUDIANTE_CARRERRA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listEstudiantesByEstudianteCarrerraLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Estudiante();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ESTUDIANTE_CARRERRA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetEstudiantesByEstudianteCarrerraLowerThan($value){
            $entity = new Estudiante();
            return $this->persistenceManager->countAll($entity, array(), $entity->ESTUDIANTE_CARRERRA." < '".$value."'");
        }

        public function getEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteCodigo($estudianteCodigo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteCodigo($estudianteCodigo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo, $firstResultNumber = null, $numResults = null){
            return $this->countGetEstudiantesByEstudianteCodigo($estudianteCodigo . "%", $firstResultNumber, $numResults);
        }

        public function getEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteCodigo("%" . $estudianteCodigo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteCodigo("%" . $estudianteCodigo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo, $firstResultNumber = null, $numResults = null){
            return $this->countGetEstudiantesByEstudianteCodigo("%" . $estudianteCodigo, $firstResultNumber, $numResults);
        }

        public function getEstudiantesByEstudianteCodigoContains($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteCodigo("%" . $estudianteCodigo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteCodigoContains($estudianteCodigo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteCodigo("%" . $estudianteCodigo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteCodigoContains($estudianteCodigo){
            return $this->countGetEstudiantesByEstudianteCodigo("%" . $estudianteCodigo . "%");
        }

        public function getEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteFacultad($estudianteFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteFacultad($estudianteFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad, $firstResultNumber = null, $numResults = null){
            return $this->countGetEstudiantesByEstudianteFacultad($estudianteFacultad . "%", $firstResultNumber, $numResults);
        }

        public function getEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteFacultad("%" . $estudianteFacultad, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteFacultad("%" . $estudianteFacultad, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad, $firstResultNumber = null, $numResults = null){
            return $this->countGetEstudiantesByEstudianteFacultad("%" . $estudianteFacultad, $firstResultNumber, $numResults);
        }

        public function getEstudiantesByEstudianteFacultadContains($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteFacultad("%" . $estudianteFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteFacultadContains($estudianteFacultad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteFacultad("%" . $estudianteFacultad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteFacultadContains($estudianteFacultad){
            return $this->countGetEstudiantesByEstudianteFacultad("%" . $estudianteFacultad . "%");
        }

        public function getEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteCarrerra($estudianteCarrerra . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteCarrerra($estudianteCarrerra . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra, $firstResultNumber = null, $numResults = null){
            return $this->countGetEstudiantesByEstudianteCarrerra($estudianteCarrerra . "%", $firstResultNumber, $numResults);
        }

        public function getEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteCarrerra("%" . $estudianteCarrerra, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteCarrerra("%" . $estudianteCarrerra, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra, $firstResultNumber = null, $numResults = null){
            return $this->countGetEstudiantesByEstudianteCarrerra("%" . $estudianteCarrerra, $firstResultNumber, $numResults);
        }

        public function getEstudiantesByEstudianteCarrerraContains($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getEstudiantesByEstudianteCarrerra("%" . $estudianteCarrerra . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listEstudiantesByEstudianteCarrerraContains($estudianteCarrerra, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listEstudiantesByEstudianteCarrerra("%" . $estudianteCarrerra . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetEstudiantesByEstudianteCarrerraContains($estudianteCarrerra){
            return $this->countGetEstudiantesByEstudianteCarrerra("%" . $estudianteCarrerra . "%");
        }

        public function updateEstudianteCodigo(Estudiante $entity,  $estudianteCodigo){
            $entity->setEstudianteCodigo($estudianteCodigo);
            return $this->persistenceManager->update($entity);
        }

        public function updateEstudianteFacultad(Estudiante $entity,  $estudianteFacultad){
            $entity->setEstudianteFacultad($estudianteFacultad);
            return $this->persistenceManager->update($entity);
        }

        public function updateEstudianteCarrerra(Estudiante $entity,  $estudianteCarrerra){
            $entity->setEstudianteCarrerra($estudianteCarrerra);
            return $this->persistenceManager->update($entity);
        }

        public function updateEstudiantePersona(Estudiante $entity, Persona $estudiantePersona){
            $entity->setEstudiantePersona($estudiantePersona->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setEstudiante(Estudiante &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setEstudiantes(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateEstudiante(Estudiante &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeEstudiante(Estudiante $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>