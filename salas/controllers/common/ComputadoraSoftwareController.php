<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.COMPUTADORA_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SOFTWARE_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_SOFTWARE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.COMPUTADORA_SOFTWARE_BEAN;

    

    class ComputadoraSoftwareController {

        private $ID = 4000;

        private $persistenceManager;
        private $lastRequestSize;

        private $computadoraSoftwareBean;

        function ComputadoraSoftwareController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->computadoraSoftwareBean = new ComputadoraSoftwareBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar ComputadoraSoftware al sistema.
         * 
         * @param ComputadoraSoftwareDTO $computadoraSoftwareDTO
        */
        public function setComputadoraSoftware(ComputadoraSoftwareDTO &$computadoraSoftwareDTO){
            $computadoraSoftware = ComputadoraSoftwareDTO::toEntity($computadoraSoftwareDTO);
            $computadoraBean = new ComputadoraBean($this->persistenceManager);
            $computadora = new Computadora();
            $softwareBean = new SoftwareBean($this->persistenceManager);
            $software = new Software();

            # Validamos los campos
            if(!$computadoraSoftware->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($computadoraSoftware->getComputadora() !== null){
                $computadora->setId($computadoraSoftware->getComputadora());
                if(!$computadoraBean->getComputadora($computadora)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            if($computadoraSoftware->getSoftware() !== null){
                $software->setId($computadoraSoftware->getSoftware());
                if(!$softwareBean->getSoftware($software)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 1);
                }
            }

            # Almacenamos la entidad
            if(!$this->computadoraSoftwareBean->setComputadoraSoftware($computadoraSoftware)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 3);
            }

            $computadoraSoftwareDTO->loadFromEntity($computadoraSoftware);
        }
        /**
         * Actualizar ComputadoraSoftware al sistema.
         * 
         * @param ComputadoraSoftwareDTO $computadoraSoftwareDTO
        */
        public function updateComputadoraSoftware(ComputadoraSoftwareDTO &$computadoraSoftwareDTO){
            $computadoraSoftware = ComputadoraSoftwareDTO::toEntity($computadoraSoftwareDTO);
            $computadoraBean = new ComputadoraBean($this->persistenceManager);
            $computadora = new Computadora();
            $softwareBean = new SoftwareBean($this->persistenceManager);
            $software = new Software();

            # Validamos los campos
            if(!$computadoraSoftware->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($computadoraSoftware->getComputadora() !== null){
                $computadora->setId($computadoraSoftware->getComputadora());
                if(!$computadoraBean->getComputadora($computadora)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 4);
                }
            }

            if($computadoraSoftware->getSoftware() !== null){
                $software->setId($computadoraSoftware->getSoftware());
                if(!$softwareBean->getSoftware($software)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 5);
                }
            }

            # Actualizamos la entidad
            if(!$this->computadoraSoftwareBean->updateComputadoraSoftware($computadoraSoftware)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 7);
            }

            $computadoraSoftwareDTO->loadFromEntity($computadoraSoftware);
        }
        /**
         * Obtener un ComputadoraSoftware único.
         * 
         * @param ComputadoraSoftwareDTO &$computadoraSoftwareDTO
        */

        public function getComputadoraSoftware(ComputadoraSoftwareDTO &$computadoraSoftwareDTO){

            $computadoraSoftware = ComputadoraSoftwareDTO::toEntity($computadoraSoftwareDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($computadoraSoftware->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            # Obtenemos la entidad
            if(!$this->computadoraSoftwareBean->getComputadoraSoftware($computadoraSoftware)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 9);
            }

            $computadoraSoftwareDTO->loadFromEntity($computadoraSoftware);
        }
        /**
         * Obtener todos los ComputadoraSoftware
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getComputadoraSoftwares($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countAllComputadoraSoftwares();
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getAllComputadoraSoftwares($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los ComputadoraSoftware
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listComputadoraSoftwares($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countAllComputadoraSoftwares();
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listAllComputadoraSoftwares($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos ComputadoraSoftware dado $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma );
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByNumeroSeriePrograma($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 18);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 20);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 22);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 19);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 21);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 23);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByNumeroSerieProgramaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 24);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 26);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 28);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 25);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 27);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 29);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByNumeroSerieProgramaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 30);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 31);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByNumeroSerieProgramaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos ComputadoraSoftware comenzando por $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos ComputadoraSoftware comenzando por $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByNumeroSerieProgramaBeginsWith($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware terminando por $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware terminando por $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByNumeroSerieProgramaEndsWith($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware que contenga $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware que contenga $numeroSeriePrograma
         * 
         * @param $numeroSeriePrograma
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if( !(EntityValidator::validateString($numeroSeriePrograma))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByNumeroSerieProgramaContains($numeroSeriePrograma, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion );
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByCompSoftFechaInstalacion($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByCompSoftFechaInstalacionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByCompSoftFechaInstalacionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByCompSoftFechaInstalacionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos ComputadoraSoftware comenzando por $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos ComputadoraSoftware comenzando por $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByCompSoftFechaInstalacionBeginsWith($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware terminando por $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware terminando por $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByCompSoftFechaInstalacionEndsWith($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware que contenga $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware que contenga $compSoftFechaInstalacion
         * 
         * @param $compSoftFechaInstalacion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByCompSoftFechaInstalacionContains($compSoftFechaInstalacion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ComputadoraSoftware dado el $computadoraId
         * 
         * @param $computadoraId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresByComputadoraId($computadoraId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ComputadoraBean($this->persistenceManager);
            $obj = new Computadora();
            $obj->setId($computadoraId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if( !EntityValidator::validateId($computadoraId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getComputadora($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 102);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByComputadora($obj);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresByComputadora($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado el $computadoraId
         * 
         * @param $computadoraId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresByComputadoraId($computadoraId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ComputadoraBean($this->persistenceManager);
            $obj = new Computadora();
            $obj->setId($computadoraId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if( !EntityValidator::validateId($computadoraId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getComputadora($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 103);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresByComputadora($obj);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresByComputadora($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }
        /**
         * Obtener algunos ComputadoraSoftware dado el $softwareId
         * 
         * @param $softwareId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadoraSoftwaresBySoftwareId($softwareId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SoftwareBean($this->persistenceManager);
            $obj = new Software();
            $obj->setId($softwareId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            if( !EntityValidator::validateId($softwareId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSoftware($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 110);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresBySoftware($obj);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->getComputadoraSoftwaresBySoftware($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ComputadoraSoftware dado el $softwareId
         * 
         * @param $softwareId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadoraSoftwaresBySoftwareId($softwareId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SoftwareBean($this->persistenceManager);
            $obj = new Software();
            $obj->setId($softwareId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            if( !EntityValidator::validateId($softwareId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSoftware($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 111);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraSoftwareBean->countGetComputadoraSoftwaresBySoftware($obj);
            }

            return ComputadoraSoftwareDTO::loadFromEntities($this->computadoraSoftwareBean->listComputadoraSoftwaresBySoftware($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un ComputadoraSoftware Dado el $computadoraSoftwareId
         * 
         * @param $computadoraSoftwareId
        */
        public function removeComputadoraSoftware($computadoraSoftwareId){

            $computadoraSoftware = new ComputadoraSoftware();
            $computadoraSoftware->setId($computadoraSoftwareId); 

            # Validamos los campos
            if( !EntityValidator::validateId($computadoraSoftwareId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            # Verificamos que la entidad exista.
            if(!$this->computadoraSoftwareBean->getComputadoraSoftware($computadoraSoftware)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 113);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->computadoraSoftwareBean->removeComputadoraSoftware($computadoraSoftware)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 114);
            }

        }

    }

?>