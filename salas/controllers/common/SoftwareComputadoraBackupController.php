<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_COMPUTADORA_BACKUP_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SOFTWARE_COMPUTADORA_BACKUP_BEAN;

    

    class SoftwareComputadoraBackupController {

        private $ID = 0;

        private $persistenceManager;
        private $lastRequestSize;

        private $softwareComputadoraBackupBean;

        function SoftwareComputadoraBackupController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->softwareComputadoraBackupBean = new SoftwareComputadoraBackupBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar SoftwareComputadoraBackup al sistema.
         * 
         * @param SoftwareComputadoraBackupDTO $softwareComputadoraBackupDTO
        */
        public function setSoftwareComputadoraBackup(SoftwareComputadoraBackupDTO &$softwareComputadoraBackupDTO){
            $softwareComputadoraBackup = SoftwareComputadoraBackupDTO::toEntity($softwareComputadoraBackupDTO);

            # Validamos los campos
            if(!$softwareComputadoraBackup->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->softwareComputadoraBackupBean->setSoftwareComputadoraBackup($softwareComputadoraBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $softwareComputadoraBackupDTO->loadFromEntity($softwareComputadoraBackup);
        }
        /**
         * Actualizar SoftwareComputadoraBackup al sistema.
         * 
         * @param SoftwareComputadoraBackupDTO $softwareComputadoraBackupDTO
        */
        public function updateSoftwareComputadoraBackup(SoftwareComputadoraBackupDTO &$softwareComputadoraBackupDTO){
            $softwareComputadoraBackup = SoftwareComputadoraBackupDTO::toEntity($softwareComputadoraBackupDTO);

            # Validamos los campos
            if(!$softwareComputadoraBackup->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->softwareComputadoraBackupBean->updateSoftwareComputadoraBackup($softwareComputadoraBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $softwareComputadoraBackupDTO->loadFromEntity($softwareComputadoraBackup);
        }
        /**
         * Obtener un SoftwareComputadoraBackup único.
         * 
         * @param SoftwareComputadoraBackupDTO &$softwareComputadoraBackupDTO
        */

        public function getSoftwareComputadoraBackup(SoftwareComputadoraBackupDTO &$softwareComputadoraBackupDTO){

            $softwareComputadoraBackup = SoftwareComputadoraBackupDTO::toEntity($softwareComputadoraBackupDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($softwareComputadoraBackup->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->softwareComputadoraBackupBean->getSoftwareComputadoraBackup($softwareComputadoraBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $softwareComputadoraBackupDTO->loadFromEntity($softwareComputadoraBackup);
        }
        /**
         * Obtener todos los SoftwareComputadoraBackup
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getSoftwareComputadoraBackups($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countAllSoftwareComputadoraBackups();
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getAllSoftwareComputadoraBackups($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los SoftwareComputadoraBackup
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listSoftwareComputadoraBackups($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countAllSoftwareComputadoraBackups();
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listAllSoftwareComputadoraBackups($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado $idSoftwareComputadora
         * 
         * @param $idSoftwareComputadora
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if( !(EntityValidator::validateNumber($idSoftwareComputadora))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora );
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado $idSoftwareComputadora
         * 
         * @param $idSoftwareComputadora
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if( !(EntityValidator::validateNumber($idSoftwareComputadora))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 18);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 19);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 20);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 22);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 24);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 21);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 23);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 25);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 26);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 28);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 30);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 27);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 29);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 31);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup );
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos SoftwareComputadoraBackup comenzando por $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos SoftwareComputadoraBackup comenzando por $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup terminando por $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup terminando por $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup que contenga $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup que contenga $numeroSerieProgramaBackup
         * 
         * @param $numeroSerieProgramaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            if( !(EntityValidator::validateString($numeroSerieProgramaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup );
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos SoftwareComputadoraBackup comenzando por $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos SoftwareComputadoraBackup comenzando por $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup terminando por $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup terminando por $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup que contenga $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup que contenga $compSoftFechaInstalacionBackup
         * 
         * @param $compSoftFechaInstalacionBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if( !(EntityValidator::validateString($compSoftFechaInstalacionBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado $computadoraBackup
         * 
         * @param $computadoraBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if( !(EntityValidator::validateNumber($computadoraBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup );
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado $computadoraBackup
         * 
         * @param $computadoraBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if( !(EntityValidator::validateNumber($computadoraBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 136);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 138);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 135);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 137);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 139);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado $softwareBackup
         * 
         * @param $softwareBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 140);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 142);
            }

            if( !(EntityValidator::validateNumber($softwareBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 144);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup );
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado $softwareBackup
         * 
         * @param $softwareBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 141);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 143);
            }

            if( !(EntityValidator::validateNumber($softwareBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 145);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 146);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 148);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 150);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 147);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 149);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 151);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 152);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 154);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 156);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 153);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 155);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 157);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 158);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 160);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 162);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 159);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 161);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 163);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado $fechaBackupSC
         * 
         * @param $fechaBackupSC
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 164);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 166);
            }

            if( !(EntityValidator::validateDate($fechaBackupSC))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 168);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC );
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado $fechaBackupSC
         * 
         * @param $fechaBackupSC
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 165);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 167);
            }

            if( !(EntityValidator::validateDate($fechaBackupSC))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 169);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 170);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 172);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 174);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 171);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 173);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 175);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 176);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 178);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 180);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 177);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 179);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 181);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 182);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 184);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 186);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->getSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos SoftwareComputadoraBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 183);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 185);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 187);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareComputadoraBackupBean->countGetSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value);
            }

            return SoftwareComputadoraBackupDTO::loadFromEntities($this->softwareComputadoraBackupBean->listSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }


        /**
         * Eliminar un SoftwareComputadoraBackup Dado el $softwareComputadoraBackupId
         * 
         * @param $softwareComputadoraBackupId
        */
        public function removeSoftwareComputadoraBackup($softwareComputadoraBackupId){

            $softwareComputadoraBackup = new SoftwareComputadoraBackup();
            $softwareComputadoraBackup->setId($softwareComputadoraBackupId); 

            # Validamos los campos
            if( !EntityValidator::validateId($softwareComputadoraBackupId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 188);
            }

            # Verificamos que la entidad exista.
            if(!$this->softwareComputadoraBackupBean->getSoftwareComputadoraBackup($softwareComputadoraBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 189);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->softwareComputadoraBackupBean->removeSoftwareComputadoraBackup($softwareComputadoraBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 190);
            }

        }

    }

?>