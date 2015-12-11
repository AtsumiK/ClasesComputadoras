<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.PERSONA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.PERSONA_BEAN;
    require_once SALAS_COMP_BEANS_DIR.OBJETO_PERDIDO_BEAN;
    require_once SALAS_COMP_BEANS_DIR.PRESTAMO_BEAN;
    require_once SALAS_COMP_BEANS_DIR.IMPRESION_BEAN;
    require_once SALAS_COMP_BEANS_DIR.MONITOR_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.ESTUDIANTE_BEAN;



    class EstudianteController {

        private $ID = 13000;

        private $persistenceManager;
        private $lastRequestSize;

        private $estudianteBean;

        function EstudianteController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->estudianteBean = new EstudianteBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Estudiante al sistema.
         *
         * @param EstudianteDTO $estudianteDTO
        */
        public function setEstudiante(EstudianteDTO &$estudianteDTO){
            $estudiante = EstudianteDTO::toEntity($estudianteDTO);
            $personaBean = new PersonaBean($this->persistenceManager);
            $persona = new Persona();

            # Validamos los campos
            if(!$estudiante->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 1);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($estudiante->getEstudiantePersona() !== null){
                $persona->setId($estudiante->getEstudiantePersona());
                if(!$personaBean->getPersona($persona)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            # Almacenamos la entidad
            if(!$this->estudianteBean->setEstudiante($estudiante)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 2);
            }

            $estudianteDTO->loadFromEntity($estudiante);
        }
        /**
         * Actualizar Estudiante al sistema.
         *
         * @param EstudianteDTO $estudianteDTO
        */
        public function updateEstudiante(EstudianteDTO &$estudianteDTO){
            $estudiante = EstudianteDTO::toEntity($estudianteDTO);
            $personaBean = new PersonaBean($this->persistenceManager);
            $persona = new Persona();

            # Validamos los campos
            if(!$estudiante->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($estudiante->getEstudiantePersona() !== null){
                $persona->setId($estudiante->getEstudiantePersona());
                if(!$personaBean->getPersona($persona)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 3);
                }
            }

            # Actualizamos la entidad
            if(!$this->estudianteBean->updateEstudiante($estudiante)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 5);
            }

            $estudianteDTO->loadFromEntity($estudiante);
        }
        /**
         * Obtener un Estudiante único.
         *
         * @param EstudianteDTO &$estudianteDTO
        */

        public function getEstudiante(EstudianteDTO &$estudianteDTO){

            $estudiante = EstudianteDTO::toEntity($estudianteDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($estudiante->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Obtenemos la entidad
            if(!$this->estudianteBean->getEstudiante($estudiante)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 7);
            }

            $estudianteDTO->loadFromEntity($estudiante);
        }
        /**
         * Obtener todos los Estudiante
         *
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getEstudiantes($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countAllEstudiantes();
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getAllEstudiantes($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Estudiante
         *
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listEstudiantes($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countAllEstudiantes();
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listAllEstudiantes($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Estudiante dado $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCodigo($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigo($estudianteCodigo );
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCodigo($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCodigo($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigo($estudianteCodigo);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCodigo($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCodigoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCodigoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoBiggerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCodigoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCodigoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoBiggerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCodigoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCodigoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoLowerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCodigoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCodigoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoLowerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCodigoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Estudiante comenzando por $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Estudiante comenzando por $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCodigoBeginsWith($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante terminando por $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante terminando por $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCodigoEndsWith($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante que contenga $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCodigoContains($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoContains($estudianteCodigo);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCodigoContains($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante que contenga $estudianteCodigo
         *
         * @param $estudianteCodigo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCodigoContains($estudianteCodigo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if( !(EntityValidator::validateString($estudianteCodigo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCodigoContains($estudianteCodigo);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCodigoContains($estudianteCodigo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteFacultad($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultad($estudianteFacultad );
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteFacultad($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteFacultad($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultad($estudianteFacultad);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteFacultad($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteFacultadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteFacultadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadBiggerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteFacultadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteFacultadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadBiggerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteFacultadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteFacultadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadLowerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteFacultadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteFacultadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadLowerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteFacultadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Estudiante comenzando por $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Estudiante comenzando por $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteFacultadBeginsWith($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante terminando por $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante terminando por $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteFacultadEndsWith($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante que contenga $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteFacultadContains($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadContains($estudianteFacultad);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteFacultadContains($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante que contenga $estudianteFacultad
         *
         * @param $estudianteFacultad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteFacultadContains($estudianteFacultad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if( !(EntityValidator::validateString($estudianteFacultad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteFacultadContains($estudianteFacultad);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteFacultadContains($estudianteFacultad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCarrerra($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerra($estudianteCarrerra );
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCarrerra($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCarrerra($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerra($estudianteCarrerra);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCarrerra($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCarrerraBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCarrerraBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraBiggerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCarrerraBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCarrerraBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraBiggerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCarrerraBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCarrerraLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraLowerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCarrerraLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCarrerraLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraLowerThan($value);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCarrerraLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Estudiante comenzando por $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Estudiante comenzando por $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCarrerraBeginsWith($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante terminando por $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante terminando por $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCarrerraEndsWith($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante que contenga $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudianteCarrerraContains($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraContains($estudianteCarrerra);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudianteCarrerraContains($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante que contenga $estudianteCarrerra
         *
         * @param $estudianteCarrerra
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudianteCarrerraContains($estudianteCarrerra, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            if( !(EntityValidator::validateString($estudianteCarrerra))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 135);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudianteCarrerraContains($estudianteCarrerra);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudianteCarrerraContains($estudianteCarrerra, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Estudiante dado el $estudiantePersonaId
         *
         * @param $estudiantePersonaId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getEstudiantesByEstudiantePersonaId($estudiantePersonaId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new PersonaBean($this->persistenceManager);
            $obj = new Persona();
            $obj->setId($estudiantePersonaId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 136);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 138);
            }

            if( !EntityValidator::validateId($estudiantePersonaId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 140);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getPersona($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 142);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudiantePersona($obj);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->getEstudiantesByEstudiantePersona($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Estudiante dado el $estudiantePersonaId
         *
         * @param $estudiantePersonaId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listEstudiantesByEstudiantePersonaId($estudiantePersonaId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new PersonaBean($this->persistenceManager);
            $obj = new Persona();
            $obj->setId($estudiantePersonaId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 137);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 139);
            }

            if( !EntityValidator::validateId($estudiantePersonaId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 141);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getPersona($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 143);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->estudianteBean->countGetEstudiantesByEstudiantePersona($obj);
            }

            return EstudianteDTO::loadFromEntities($this->estudianteBean->listEstudiantesByEstudiantePersona($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un Estudiante Dado el $estudianteId
         *
         * @param $estudianteId
        */
        public function removeEstudiante($estudianteId){
            $objetoPerdidoBean = new ObjetoPerdidoBean($this->persistenceManager);
            $prestamoBean = new PrestamoBean($this->persistenceManager);
            $impresionBean = new ImpresionBean($this->persistenceManager);
            $monitorBean = new MonitorBean($this->persistenceManager);

            $estudiante = new Estudiante();
            $estudiante->setId($estudianteId);

            # Validamos los campos
            if( !EntityValidator::validateId($estudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 148);
            }

            # Verificamos que la entidad exista.
            if(!$this->estudianteBean->getEstudiante($estudiante)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 149);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Verificamos que la entidad no esté siendo utilziada en ObjetoPerdido->objetoPerdidoEstudiante
            $objetoPerdidos = $objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoEstudiante($estudiante);
            if(count($objetoPerdidos) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 144);
            }

            # Verificamos que la entidad no esté siendo utilziada en Prestamo->prestamoEstudiante
            $prestamos = $prestamoBean->getPrestamosByPrestamoEstudiante($estudiante);
            if(count($prestamos) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 145);
            }

            # Verificamos que la entidad no esté siendo utilziada en Impresion->impresionEstudiante
            $impresions = $impresionBean->getImpresionsByImpresionEstudiante($estudiante);
            if(count($impresions) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 146);
            }

            # Verificamos que la entidad no esté siendo utilziada en Monitor->monitorEstudiante
            $monitors = $monitorBean->getMonitorsByMonitorEstudiante($estudiante);
            if(count($monitors) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 147);
            }

            # Eliminamos la entidad
            if(!$this->estudianteBean->removeEstudiante($estudiante)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 150);
            }

        }

        // Funciones personalizadas
        public function darEstudiantesTopeImpresion($numMax){
            return EstudianteDTO::loadFromEntities($this->estudianteBean->darEstudiantesTopeImpresion($numMax));
        }
        public function darEstudiantesResponsables(){
            return EstudianteDTO::loadFromEntities($this->estudianteBean->darEstudiantesResponsables());
        }

    }

?>
