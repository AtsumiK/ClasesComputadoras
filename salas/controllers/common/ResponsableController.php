<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.PERSONA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.PERSONA_BEAN;
    require_once SALAS_COMP_BEANS_DIR.RESERVA_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.RESPONSABLE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.RESPONSABLE_BEAN;

    

    class ResponsableController {

        private $ID = 13000;

        private $persistenceManager;
        private $lastRequestSize;

        private $responsableBean;

        function ResponsableController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->responsableBean = new ResponsableBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Responsable al sistema.
         * 
         * @param ResponsableDTO $responsableDTO
        */
        public function setResponsable(ResponsableDTO &$responsableDTO){
            $responsable = ResponsableDTO::toEntity($responsableDTO);
            $personaBean = new PersonaBean($this->persistenceManager);
            $persona = new Persona();

            # Validamos los campos
            if(!$responsable->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 1);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($responsable->getResponsablePersona() !== null){
                $persona->setId($responsable->getResponsablePersona());
                if(!$personaBean->getPersona($persona)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            # Almacenamos la entidad
            if(!$this->responsableBean->setResponsable($responsable)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 2);
            }

            $responsableDTO->loadFromEntity($responsable);
        }
        /**
         * Actualizar Responsable al sistema.
         * 
         * @param ResponsableDTO $responsableDTO
        */
        public function updateResponsable(ResponsableDTO &$responsableDTO){
            $responsable = ResponsableDTO::toEntity($responsableDTO);
            $personaBean = new PersonaBean($this->persistenceManager);
            $persona = new Persona();

            # Validamos los campos
            if(!$responsable->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($responsable->getResponsablePersona() !== null){
                $persona->setId($responsable->getResponsablePersona());
                if(!$personaBean->getPersona($persona)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 3);
                }
            }

            # Actualizamos la entidad
            if(!$this->responsableBean->updateResponsable($responsable)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 5);
            }

            $responsableDTO->loadFromEntity($responsable);
        }
        /**
         * Obtener un Responsable único.
         * 
         * @param ResponsableDTO &$responsableDTO
        */

        public function getResponsable(ResponsableDTO &$responsableDTO){

            $responsable = ResponsableDTO::toEntity($responsableDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($responsable->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Obtenemos la entidad
            if(!$this->responsableBean->getResponsable($responsable)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 7);
            }

            $responsableDTO->loadFromEntity($responsable);
        }
        /**
         * Obtener todos los Responsable
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getResponsables($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countAllResponsables();
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getAllResponsables($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Responsable
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listResponsables($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countAllResponsables();
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listAllResponsables($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Responsable dado $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableFacultad($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultad($responsableFacultad );
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableFacultad($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableFacultad($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultad($responsableFacultad);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableFacultad($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableFacultadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 18);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 20);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadBetween($firstValue, $secondValue);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableFacultadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableFacultadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 19);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 21);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadBetween($firstValue, $secondValue);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableFacultadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableFacultadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 22);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 24);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 26);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadBiggerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableFacultadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableFacultadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 23);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 25);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 27);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadBiggerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableFacultadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableFacultadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 28);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 30);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadLowerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableFacultadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableFacultadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 29);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 31);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadLowerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableFacultadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Responsable comenzando por $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableFacultadBeginsWith($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadBeginsWith($responsableFacultad);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableFacultadBeginsWith($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Responsable comenzando por $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableFacultadBeginsWith($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadBeginsWith($responsableFacultad);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableFacultadBeginsWith($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable terminando por $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableFacultadEndsWith($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadEndsWith($responsableFacultad);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableFacultadEndsWith($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable terminando por $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableFacultadEndsWith($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadEndsWith($responsableFacultad);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableFacultadEndsWith($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable que contenga $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableFacultadContains($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadContains($responsableFacultad);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableFacultadContains($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable que contenga $responsableFacultad
         * 
         * @param $responsableFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableFacultadContains($responsableFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if( !(EntityValidator::validateString($responsableFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableFacultadContains($responsableFacultad);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableFacultadContains($responsableFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableAsignatura($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignatura($responsableAsignatura );
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableAsignatura($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableAsignatura($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignatura($responsableAsignatura);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableAsignatura($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableAsignaturaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableAsignaturaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaBiggerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableAsignaturaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableAsignaturaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaBiggerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableAsignaturaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableAsignaturaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaLowerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableAsignaturaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableAsignaturaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaLowerThan($value);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableAsignaturaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Responsable comenzando por $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Responsable comenzando por $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableAsignaturaBeginsWith($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable terminando por $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable terminando por $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableAsignaturaEndsWith($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable que contenga $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsableAsignaturaContains($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaContains($responsableAsignatura);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsableAsignaturaContains($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable que contenga $responsableAsignatura
         * 
         * @param $responsableAsignatura
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsableAsignaturaContains($responsableAsignatura, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if( !(EntityValidator::validateString($responsableAsignatura))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsableAsignaturaContains($responsableAsignatura);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsableAsignaturaContains($responsableAsignatura, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Responsable dado el $responsablePersonaId
         * 
         * @param $responsablePersonaId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getResponsablesByResponsablePersonaId($responsablePersonaId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new PersonaBean($this->persistenceManager);
            $obj = new Persona();
            $obj->setId($responsablePersonaId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if( !EntityValidator::validateId($responsablePersonaId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getPersona($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 100);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsablePersona($obj);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->getResponsablesByResponsablePersona($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Responsable dado el $responsablePersonaId
         * 
         * @param $responsablePersonaId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listResponsablesByResponsablePersonaId($responsablePersonaId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new PersonaBean($this->persistenceManager);
            $obj = new Persona();
            $obj->setId($responsablePersonaId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if( !EntityValidator::validateId($responsablePersonaId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getPersona($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 101);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->responsableBean->countGetResponsablesByResponsablePersona($obj);
            }

            return ResponsableDTO::loadFromEntities($this->responsableBean->listResponsablesByResponsablePersona($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un Responsable Dado el $responsableId
         * 
         * @param $responsableId
        */
        public function removeResponsable($responsableId){
            $reservaBean = new ReservaBean($this->persistenceManager);

            $responsable = new Responsable();
            $responsable->setId($responsableId); 

            # Validamos los campos
            if( !EntityValidator::validateId($responsableId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            # Verificamos que la entidad exista.
            if(!$this->responsableBean->getResponsable($responsable)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 104);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Verificamos que la entidad no esté siendo utilziada en Reserva->reservaResponsable
            $reservas = $reservaBean->getReservasByReservaResponsable($responsable);
            if(count($reservas) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 102);
            }

            # Eliminamos la entidad
            if(!$this->responsableBean->removeResponsable($responsable)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 105);
            }

        }

    }

?>