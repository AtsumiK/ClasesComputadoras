<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_BEANS_DIR.RESPONSABLE_BEAN;
    require_once SALAS_COMP_BEANS_DIR.ESTUDIANTE_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.PERSONA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.PERSONA_BEAN;

    

    class PersonaController {

        private $ID = 14000;

        private $persistenceManager;
        private $lastRequestSize;

        private $personaBean;

        function PersonaController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->personaBean = new PersonaBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Persona al sistema.
         * 
         * @param PersonaDTO $personaDTO
        */
        public function setPersona(PersonaDTO &$personaDTO){
            $persona = PersonaDTO::toEntity($personaDTO);

            # Validamos los campos
            if(!$persona->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->personaBean->setPersona($persona)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $personaDTO->loadFromEntity($persona);
        }
        /**
         * Actualizar Persona al sistema.
         * 
         * @param PersonaDTO $personaDTO
        */
        public function updatePersona(PersonaDTO &$personaDTO){
            $persona = PersonaDTO::toEntity($personaDTO);

            # Validamos los campos
            if(!$persona->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->personaBean->updatePersona($persona)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $personaDTO->loadFromEntity($persona);
        }
        /**
         * Obtener un Persona único.
         * 
         * @param PersonaDTO &$personaDTO
        */

        public function getPersona(PersonaDTO &$personaDTO){

            $persona = PersonaDTO::toEntity($personaDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($persona->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->personaBean->getPersona($persona)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $personaDTO->loadFromEntity($persona);
        }
        /**
         * Obtener todos los Persona
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getPersonas($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->personaBean->countAllPersonas();
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getAllPersonas($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Persona
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listPersonas($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->personaBean->countAllPersonas();
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listAllPersonas($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Persona dado $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad );
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaDocumentoIdentidad($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 18);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 19);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaDocumentoIdentidadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaDocumentoIdentidadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 20);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 22);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 24);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadBiggerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaDocumentoIdentidadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaDocumentoIdentidadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 21);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 23);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 25);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadBiggerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaDocumentoIdentidadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaDocumentoIdentidadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 26);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 28);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 30);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadLowerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaDocumentoIdentidadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaDocumentoIdentidadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 27);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 29);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 31);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadLowerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaDocumentoIdentidadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Persona comenzando por $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Persona comenzando por $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaDocumentoIdentidadBeginsWith($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona terminando por $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona terminando por $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaDocumentoIdentidadEndsWith($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona que contenga $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona que contenga $personaDocumentoIdentidad
         * 
         * @param $personaDocumentoIdentidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if( !(EntityValidator::validateString($personaDocumentoIdentidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaDocumentoIdentidadContains($personaDocumentoIdentidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaNombres($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombres($personaNombres );
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaNombres($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaNombres($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombres($personaNombres);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaNombres($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaNombresBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresBetween($firstValue, $secondValue);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaNombresBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaNombresBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresBetween($firstValue, $secondValue);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaNombresBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaNombresBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresBiggerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaNombresBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaNombresBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresBiggerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaNombresBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaNombresLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresLowerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaNombresLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaNombresLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresLowerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaNombresLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Persona comenzando por $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaNombresBeginsWith($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresBeginsWith($personaNombres);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaNombresBeginsWith($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Persona comenzando por $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaNombresBeginsWith($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresBeginsWith($personaNombres);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaNombresBeginsWith($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona terminando por $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaNombresEndsWith($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresEndsWith($personaNombres);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaNombresEndsWith($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona terminando por $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaNombresEndsWith($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresEndsWith($personaNombres);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaNombresEndsWith($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona que contenga $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaNombresContains($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresContains($personaNombres);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaNombresContains($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona que contenga $personaNombres
         * 
         * @param $personaNombres
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaNombresContains($personaNombres, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if( !(EntityValidator::validateString($personaNombres))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaNombresContains($personaNombres);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaNombresContains($personaNombres, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaApellidos($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidos($personaApellidos );
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaApellidos($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaApellidos($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidos($personaApellidos);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaApellidos($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaApellidosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosBetween($firstValue, $secondValue);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaApellidosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaApellidosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosBetween($firstValue, $secondValue);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaApellidosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaApellidosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosBiggerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaApellidosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaApellidosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosBiggerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaApellidosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaApellidosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosLowerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaApellidosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaApellidosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosLowerThan($value);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaApellidosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Persona comenzando por $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaApellidosBeginsWith($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosBeginsWith($personaApellidos);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaApellidosBeginsWith($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Persona comenzando por $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaApellidosBeginsWith($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosBeginsWith($personaApellidos);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaApellidosBeginsWith($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona terminando por $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaApellidosEndsWith($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosEndsWith($personaApellidos);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaApellidosEndsWith($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona terminando por $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaApellidosEndsWith($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosEndsWith($personaApellidos);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaApellidosEndsWith($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Persona que contenga $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPersonasByPersonaApellidosContains($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosContains($personaApellidos);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->getPersonasByPersonaApellidosContains($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Persona que contenga $personaApellidos
         * 
         * @param $personaApellidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPersonasByPersonaApellidosContains($personaApellidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if( !(EntityValidator::validateString($personaApellidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->personaBean->countGetPersonasByPersonaApellidosContains($personaApellidos);
            }

            return PersonaDTO::loadFromEntities($this->personaBean->listPersonasByPersonaApellidosContains($personaApellidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }


        /**
         * Eliminar un Persona Dado el $personaId
         * 
         * @param $personaId
        */
        public function removePersona($personaId){
            $responsableBean = new ResponsableBean($this->persistenceManager);
            $estudianteBean = new EstudianteBean($this->persistenceManager);

            $persona = new Persona();
            $persona->setId($personaId); 

            # Validamos los campos
            if( !EntityValidator::validateId($personaId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 136);
            }

            # Verificamos que la entidad exista.
            if(!$this->personaBean->getPersona($persona)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 137);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Verificamos que la entidad no esté siendo utilziada en Responsable->responsablePersona
            $responsables = $responsableBean->getResponsablesByResponsablePersona($persona);
            if(count($responsables) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 134);
            }

            # Verificamos que la entidad no esté siendo utilziada en Estudiante->estudiantePersona
            $estudiantes = $estudianteBean->getEstudiantesByEstudiantePersona($persona);
            if(count($estudiantes) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 135);
            }

            # Eliminamos la entidad
            if(!$this->personaBean->removePersona($persona)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 138);
            }

        }

    }

?>