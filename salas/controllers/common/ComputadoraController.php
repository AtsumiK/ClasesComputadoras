<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_BEANS_DIR.OBJETO_EN_INVENTARIO_BEAN;
    require_once SALAS_COMP_BEANS_DIR.COMPUTADORA_SOFTWARE_BEAN;
    require_once SALAS_COMP_BEANS_DIR.PRESTAMO_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.COMPUTADORA_BEAN;

    

    class ComputadoraController {

        private $ID = 3000;

        private $persistenceManager;
        private $lastRequestSize;

        private $computadoraBean;

        function ComputadoraController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->computadoraBean = new ComputadoraBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Computadora al sistema.
         * 
         * @param ComputadoraDTO $computadoraDTO
        */
        public function setComputadora(ComputadoraDTO &$computadoraDTO){
            $computadora = ComputadoraDTO::toEntity($computadoraDTO);

            # Validamos los campos
            if(!$computadora->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->computadoraBean->setComputadora($computadora)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $computadoraDTO->loadFromEntity($computadora);
        }
        /**
         * Actualizar Computadora al sistema.
         * 
         * @param ComputadoraDTO $computadoraDTO
        */
        public function updateComputadora(ComputadoraDTO &$computadoraDTO){
            $computadora = ComputadoraDTO::toEntity($computadoraDTO);

            # Validamos los campos
            if(!$computadora->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->computadoraBean->updateComputadora($computadora)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $computadoraDTO->loadFromEntity($computadora);
        }
        /**
         * Obtener un Computadora único.
         * 
         * @param ComputadoraDTO &$computadoraDTO
        */

        public function getComputadora(ComputadoraDTO &$computadoraDTO){

            $computadora = ComputadoraDTO::toEntity($computadoraDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($computadora->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->computadoraBean->getComputadora($computadora)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $computadoraDTO->loadFromEntity($computadora);
        }
        /**
         * Obtener todos los Computadora
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getComputadoras($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countAllComputadoras();
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getAllComputadoras($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Computadora
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listComputadoras($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countAllComputadoras();
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listAllComputadoras($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Computadora dado $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraNombre($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombre($computadoraNombre );
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraNombre($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraNombre($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombre($computadoraNombre);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraNombre($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraNombreBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraNombreBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraNombreBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraNombreBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraNombreBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraNombreBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraNombreBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraNombreBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraNombreLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraNombreLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraNombreLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraNombreLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Computadora comenzando por $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraNombreBeginsWith($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreBeginsWith($computadoraNombre);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraNombreBeginsWith($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Computadora comenzando por $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraNombreBeginsWith($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreBeginsWith($computadoraNombre);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraNombreBeginsWith($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora terminando por $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraNombreEndsWith($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreEndsWith($computadoraNombre);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraNombreEndsWith($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora terminando por $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraNombreEndsWith($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreEndsWith($computadoraNombre);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraNombreEndsWith($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora que contenga $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraNombreContains($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreContains($computadoraNombre);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraNombreContains($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora que contenga $computadoraNombre
         * 
         * @param $computadoraNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraNombreContains($computadoraNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if( !(EntityValidator::validateString($computadoraNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraNombreContains($computadoraNombre);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraNombreContains($computadoraNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraRam($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRam($computadoraRam );
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraRam($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraRam($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRam($computadoraRam);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraRam($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraRamBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraRamBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraRamBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraRamBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraRamBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraRamBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraRamBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraRamBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraRamLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraRamLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraRamLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraRamLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Computadora comenzando por $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraRamBeginsWith($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamBeginsWith($computadoraRam);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraRamBeginsWith($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Computadora comenzando por $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraRamBeginsWith($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamBeginsWith($computadoraRam);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraRamBeginsWith($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora terminando por $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraRamEndsWith($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamEndsWith($computadoraRam);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraRamEndsWith($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora terminando por $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraRamEndsWith($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamEndsWith($computadoraRam);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraRamEndsWith($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora que contenga $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraRamContains($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamContains($computadoraRam);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraRamContains($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora que contenga $computadoraRam
         * 
         * @param $computadoraRam
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraRamContains($computadoraRam, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if( !(EntityValidator::validateString($computadoraRam))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraRamContains($computadoraRam);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraRamContains($computadoraRam, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraProcesador($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesador($computadoraProcesador );
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraProcesador($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraProcesador($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesador($computadoraProcesador);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraProcesador($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraProcesadorBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraProcesadorBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraProcesadorBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraProcesadorBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraProcesadorBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraProcesadorLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraProcesadorLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraProcesadorLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraProcesadorLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Computadora comenzando por $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Computadora comenzando por $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraProcesadorBeginsWith($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora terminando por $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora terminando por $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraProcesadorEndsWith($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora que contenga $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraProcesadorContains($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorContains($computadoraProcesador);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraProcesadorContains($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora que contenga $computadoraProcesador
         * 
         * @param $computadoraProcesador
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraProcesadorContains($computadoraProcesador, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if( !(EntityValidator::validateString($computadoraProcesador))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraProcesadorContains($computadoraProcesador);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraProcesadorContains($computadoraProcesador, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 136);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 138);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro );
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 135);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 137);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 139);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDiscoDuro($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 140);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 142);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 144);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 141);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 143);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 145);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDiscoDuroBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDiscoDuroBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 146);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 148);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 150);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDiscoDuroBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDiscoDuroBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 147);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 149);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 151);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDiscoDuroBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDiscoDuroLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 152);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 154);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 156);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDiscoDuroLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDiscoDuroLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 153);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 155);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 157);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDiscoDuroLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Computadora comenzando por $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 158);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 160);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 162);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Computadora comenzando por $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 159);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 161);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 163);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDiscoDuroBeginsWith($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora terminando por $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 164);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 166);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 168);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora terminando por $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 165);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 167);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 169);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDiscoDuroEndsWith($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora que contenga $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 170);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 172);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 174);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora que contenga $computadoraDiscoDuro
         * 
         * @param $computadoraDiscoDuro
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 171);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 173);
            }

            if( !(EntityValidator::validateString($computadoraDiscoDuro))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 175);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDiscoDuroContains($computadoraDiscoDuro, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirIp($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 176);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 178);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 180);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIp($computadoraDirIp );
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirIp($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirIp($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 177);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 179);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 181);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIp($computadoraDirIp);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirIp($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirIpBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 182);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 184);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 186);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirIpBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirIpBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 183);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 185);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 187);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirIpBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirIpBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 188);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 190);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 192);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirIpBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirIpBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 189);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 191);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 193);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirIpBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirIpLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 194);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 196);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 198);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirIpLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirIpLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 195);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 197);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 199);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirIpLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Computadora comenzando por $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 200);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 202);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 204);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Computadora comenzando por $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 201);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 203);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 205);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirIpBeginsWith($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora terminando por $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirIpEndsWith($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 206);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 208);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 210);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpEndsWith($computadoraDirIp);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirIpEndsWith($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora terminando por $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirIpEndsWith($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 207);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 209);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 211);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpEndsWith($computadoraDirIp);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirIpEndsWith($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora que contenga $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirIpContains($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 212);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 214);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 216);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpContains($computadoraDirIp);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirIpContains($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora que contenga $computadoraDirIp
         * 
         * @param $computadoraDirIp
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirIpContains($computadoraDirIp, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 213);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 215);
            }

            if( !(EntityValidator::validateString($computadoraDirIp))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 217);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirIpContains($computadoraDirIp);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirIpContains($computadoraDirIp, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirMac($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 218);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 220);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 222);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMac($computadoraDirMac );
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirMac($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirMac($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 219);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 221);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 223);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMac($computadoraDirMac);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirMac($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirMacBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 224);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 226);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 228);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirMacBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirMacBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 225);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 227);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 229);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacBetween($firstValue, $secondValue);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirMacBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirMacBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 230);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 232);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 234);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirMacBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirMacBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 231);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 233);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 235);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacBiggerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirMacBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirMacLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 236);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 238);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 240);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirMacLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirMacLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 237);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 239);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 241);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacLowerThan($value);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirMacLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Computadora comenzando por $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 242);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 244);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 246);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Computadora comenzando por $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 243);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 245);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 247);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirMacBeginsWith($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora terminando por $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirMacEndsWith($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 248);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 250);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 252);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacEndsWith($computadoraDirMac);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirMacEndsWith($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora terminando por $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirMacEndsWith($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 249);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 251);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 253);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacEndsWith($computadoraDirMac);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirMacEndsWith($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora que contenga $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByComputadoraDirMacContains($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 254);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 256);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 258);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacContains($computadoraDirMac);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByComputadoraDirMacContains($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora que contenga $computadoraDirMac
         * 
         * @param $computadoraDirMac
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByComputadoraDirMacContains($computadoraDirMac, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 255);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 257);
            }

            if( !(EntityValidator::validateString($computadoraDirMac))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 259);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByComputadoraDirMacContains($computadoraDirMac);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByComputadoraDirMacContains($computadoraDirMac, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Computadora dado el $computaoraObjetosInventarioId
         * 
         * @param $computaoraObjetosInventarioId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getComputadorasByObjetoEnInventarioId($objetoEnInventarioId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ObjetoEnInventarioBean($this->persistenceManager);
            $obj = new ObjetoEnInventario();
            $obj->setId($objetoEnInventarioId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 260);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 262);
            }

            if( !EntityValidator::validateId($objetoEnInventarioId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 264);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getObjetoEnInventario($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 266);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByObjetoEnInventario($obj);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->getComputadorasByObjetoEnInventario($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Computadora dado el $computaoraObjetosInventarioId
         * 
         * @param $computaoraObjetosInventarioId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listComputadorasByObjetoEnInventarioId($objetoEnInventarioId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ObjetoEnInventarioBean($this->persistenceManager);
            $obj = new ObjetoEnInventario();
            $obj->setId($objetoEnInventarioId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 261);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 263);
            }

            if( !EntityValidator::validateId($objetoEnInventarioId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 265);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getObjetoEnInventario($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 267);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->computadoraBean->countGetComputadorasByObjetoEnInventario($obj);
            }

            return ComputadoraDTO::loadFromEntities($this->computadoraBean->listComputadorasByObjetoEnInventario($obj, $firstResultNumber, $numResults, $orderBy , $orderPriority));

        }

        /**
         * Eliminar un Computadora Dado el $computadoraId
         * 
         * @param $computadoraId
        */
        public function removeComputadora($computadoraId){
            $computadoraSoftwareBean = new ComputadoraSoftwareBean($this->persistenceManager);
            $prestamoBean = new PrestamoBean($this->persistenceManager);
            $objetoEnInventarioBean = new ObjetoEnInventarioBean($this->persistenceManager);

            $computadora = new Computadora();
            $computadora->setId($computadoraId); 

            # Validamos los campos
            if( !EntityValidator::validateId($computadoraId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 271);
            }

            # Verificamos que la entidad exista.
            if(!$this->computadoraBean->getComputadora($computadora)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 272);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Verificamos que la entidad no esté siendo utilziada en ComputadoraSoftware->computadora
            $computadoraSoftwares = $computadoraSoftwareBean->getComputadoraSoftwaresByComputadora($computadora);
            if(count($computadoraSoftwares) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 268);
            }

            # Verificamos que la entidad no esté siendo utilziada en Prestamo->prestamoComputadora
            $prestamos = $prestamoBean->getPrestamosByPrestamoComputadora($computadora);
            if(count($prestamos) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 269);
            }

            # Verificamos que no esté relacionada con ObjetoEnInventario
            $objetoEnInventarios = $objetoEnInventarioBean->getObjetoEnInventariosByComputadora($computadora);
            if(count($objetoEnInventarios) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 270);
            }

            # Eliminamos la entidad
            if(!$this->computadoraBean->removeComputadora($computadora)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 273);
            }

        }

    }

?>