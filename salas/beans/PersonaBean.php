<?php

    require_once SALAS_COMP_ENTITIES_DIR.PERSONA_ENTITY;

    

    class PersonaBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function PersonaBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getPersona(Persona &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllPersonas($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllPersonas($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllPersonas(){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_DOCUMENTO_IDENTIDAD." LIKE '".$personaDocumentoIdentidad."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_DOCUMENTO_IDENTIDAD." LIKE '".$personaDocumentoIdentidad."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_DOCUMENTO_IDENTIDAD." LIKE '".$personaDocumentoIdentidad."'");

        }
        public function getPersonasByPersonaNombres($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_NOMBRES." LIKE '".$personaNombres."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaNombres($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_NOMBRES." LIKE '".$personaNombres."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaNombres($personaNombres){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_NOMBRES." LIKE '".$personaNombres."'");

        }
        public function getPersonasByPersonaApellidos($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_APELLIDOS." LIKE '".$personaApellidos."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaApellidos($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_APELLIDOS." LIKE '".$personaApellidos."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaApellidos($personaApellidos){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_APELLIDOS." LIKE '".$personaApellidos."'");

        }
        public function getPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_DOCUMENTO_IDENTIDAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_DOCUMENTO_IDENTIDAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PERSONA_DOCUMENTO_IDENTIDAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPersonasByPersonaNombresBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_NOMBRES." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaNombresBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_NOMBRES." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaNombresBetween($firstValue, $secondValue){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PERSONA_NOMBRES." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPersonasByPersonaApellidosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_APELLIDOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaApellidosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_APELLIDOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaApellidosBetween($firstValue, $secondValue){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PERSONA_APELLIDOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPersonasByPersonaDocumentoIdentidadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_DOCUMENTO_IDENTIDAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaDocumentoIdentidadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_DOCUMENTO_IDENTIDAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaDocumentoIdentidadBiggerThan($value){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_DOCUMENTO_IDENTIDAD." > '".$value."'");
        }

        public function getPersonasByPersonaNombresBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_NOMBRES." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaNombresBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_NOMBRES." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaNombresBiggerThan($value){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_NOMBRES." > '".$value."'");
        }

        public function getPersonasByPersonaApellidosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_APELLIDOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaApellidosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_APELLIDOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaApellidosBiggerThan($value){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_APELLIDOS." > '".$value."'");
        }

        public function getPersonasByPersonaDocumentoIdentidadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_DOCUMENTO_IDENTIDAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaDocumentoIdentidadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_DOCUMENTO_IDENTIDAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaDocumentoIdentidadLowerThan($value){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_DOCUMENTO_IDENTIDAD." < '".$value."'");
        }

        public function getPersonasByPersonaNombresLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_NOMBRES." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaNombresLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_NOMBRES." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaNombresLowerThan($value){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_NOMBRES." < '".$value."'");
        }

        public function getPersonasByPersonaApellidosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PERSONA_APELLIDOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPersonasByPersonaApellidosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Persona();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PERSONA_APELLIDOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPersonasByPersonaApellidosLowerThan($value){
            $entity = new Persona();
            return $this->persistenceManager->countAll($entity, array(), $entity->PERSONA_APELLIDOS." < '".$value."'");
        }

        public function getPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null){
            return $this->countGetPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad . "%", $firstResultNumber, $numResults);
        }

        public function getPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaDocumentoIdentidad("%" . $personaDocumentoIdentidad, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaDocumentoIdentidad("%" . $personaDocumentoIdentidad, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null){
            return $this->countGetPersonasByPersonaDocumentoIdentidad("%" . $personaDocumentoIdentidad, $firstResultNumber, $numResults);
        }

        public function getPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaDocumentoIdentidad("%" . $personaDocumentoIdentidad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaDocumentoIdentidad("%" . $personaDocumentoIdentidad . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad){
            return $this->countGetPersonasByPersonaDocumentoIdentidad("%" . $personaDocumentoIdentidad . "%");
        }

        public function getPersonasByPersonaNombresBeginsWith($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaNombres($personaNombres . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaNombresBeginsWith($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaNombres($personaNombres . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaNombresBeginsWith($personaNombres, $firstResultNumber = null, $numResults = null){
            return $this->countGetPersonasByPersonaNombres($personaNombres . "%", $firstResultNumber, $numResults);
        }

        public function getPersonasByPersonaNombresEndsWith($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaNombres("%" . $personaNombres, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaNombresEndsWith($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaNombres("%" . $personaNombres, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaNombresEndsWith($personaNombres, $firstResultNumber = null, $numResults = null){
            return $this->countGetPersonasByPersonaNombres("%" . $personaNombres, $firstResultNumber, $numResults);
        }

        public function getPersonasByPersonaNombresContains($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaNombres("%" . $personaNombres . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaNombresContains($personaNombres, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaNombres("%" . $personaNombres . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaNombresContains($personaNombres){
            return $this->countGetPersonasByPersonaNombres("%" . $personaNombres . "%");
        }

        public function getPersonasByPersonaApellidosBeginsWith($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaApellidos($personaApellidos . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaApellidosBeginsWith($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaApellidos($personaApellidos . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaApellidosBeginsWith($personaApellidos, $firstResultNumber = null, $numResults = null){
            return $this->countGetPersonasByPersonaApellidos($personaApellidos . "%", $firstResultNumber, $numResults);
        }

        public function getPersonasByPersonaApellidosEndsWith($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaApellidos("%" . $personaApellidos, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaApellidosEndsWith($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaApellidos("%" . $personaApellidos, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaApellidosEndsWith($personaApellidos, $firstResultNumber = null, $numResults = null){
            return $this->countGetPersonasByPersonaApellidos("%" . $personaApellidos, $firstResultNumber, $numResults);
        }

        public function getPersonasByPersonaApellidosContains($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPersonasByPersonaApellidos("%" . $personaApellidos . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPersonasByPersonaApellidosContains($personaApellidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPersonasByPersonaApellidos("%" . $personaApellidos . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPersonasByPersonaApellidosContains($personaApellidos){
            return $this->countGetPersonasByPersonaApellidos("%" . $personaApellidos . "%");
        }

        public function updatePersonaDocumentoIdentidad(Persona $entity,  $personaDocumentoIdentidad){
            $entity->setPersonaDocumentoIdentidad($personaDocumentoIdentidad);
            return $this->persistenceManager->update($entity);
        }

        public function updatePersonaNombres(Persona $entity,  $personaNombres){
            $entity->setPersonaNombres($personaNombres);
            return $this->persistenceManager->update($entity);
        }

        public function updatePersonaApellidos(Persona $entity,  $personaApellidos){
            $entity->setPersonaApellidos($personaApellidos);
            return $this->persistenceManager->update($entity);
        }

        public function setPersona(Persona &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setPersonas(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updatePersona(Persona &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removePersona(Persona $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>