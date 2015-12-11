<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.PRESTAMO_BACKUP_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.PRESTAMO_BACKUP_BEAN;

    

    class PrestamoBackupController {

        private $ID = 0;

        private $persistenceManager;
        private $lastRequestSize;

        private $prestamoBackupBean;

        function PrestamoBackupController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->prestamoBackupBean = new PrestamoBackupBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar PrestamoBackup al sistema.
         * 
         * @param PrestamoBackupDTO $prestamoBackupDTO
        */
        public function setPrestamoBackup(PrestamoBackupDTO &$prestamoBackupDTO){
            $prestamoBackup = PrestamoBackupDTO::toEntity($prestamoBackupDTO);

            # Validamos los campos
            if(!$prestamoBackup->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->prestamoBackupBean->setPrestamoBackup($prestamoBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $prestamoBackupDTO->loadFromEntity($prestamoBackup);
        }
        /**
         * Actualizar PrestamoBackup al sistema.
         * 
         * @param PrestamoBackupDTO $prestamoBackupDTO
        */
        public function updatePrestamoBackup(PrestamoBackupDTO &$prestamoBackupDTO){
            $prestamoBackup = PrestamoBackupDTO::toEntity($prestamoBackupDTO);

            # Validamos los campos
            if(!$prestamoBackup->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->prestamoBackupBean->updatePrestamoBackup($prestamoBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $prestamoBackupDTO->loadFromEntity($prestamoBackup);
        }
        /**
         * Obtener un PrestamoBackup único.
         * 
         * @param PrestamoBackupDTO &$prestamoBackupDTO
        */

        public function getPrestamoBackup(PrestamoBackupDTO &$prestamoBackupDTO){

            $prestamoBackup = PrestamoBackupDTO::toEntity($prestamoBackupDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($prestamoBackup->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->prestamoBackupBean->getPrestamoBackup($prestamoBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $prestamoBackupDTO->loadFromEntity($prestamoBackup);
        }
        /**
         * Obtener todos los PrestamoBackup
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getPrestamoBackups($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countAllPrestamoBackups();
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getAllPrestamoBackups($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los PrestamoBackup
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listPrestamoBackups($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countAllPrestamoBackups();
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listAllPrestamoBackups($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos PrestamoBackup dado $prestamoId
         * 
         * @param $prestamoId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoId($prestamoId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if( !(EntityValidator::validateNumber($prestamoId))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoId($prestamoId );
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoId($prestamoId, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado $prestamoId
         * 
         * @param $prestamoId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoId($prestamoId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if( !(EntityValidator::validateNumber($prestamoId))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoId($prestamoId);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoId($prestamoId, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoIdBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoIdBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoIdBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoIdBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoIdBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoIdBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoIdLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoIdLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoIdLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoIdLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoIdLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoIdLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado $prestamoEntradaBackup
         * 
         * @param $prestamoEntradaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if( !(EntityValidator::validateDate($prestamoEntradaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup );
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado $prestamoEntradaBackup
         * 
         * @param $prestamoEntradaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if( !(EntityValidator::validateDate($prestamoEntradaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEntradaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEntradaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEntradaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEntradaBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEntradaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado $prestamoSalidaBackup
         * 
         * @param $prestamoSalidaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            if( !(EntityValidator::validateDate($prestamoSalidaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup );
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado $prestamoSalidaBackup
         * 
         * @param $prestamoSalidaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            if( !(EntityValidator::validateDate($prestamoSalidaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoSalidaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoSalidaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoSalidaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoSalidaBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoSalidaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup );
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComentariosBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComentariosBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComentariosBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComentariosBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos PrestamoBackup comenzando por $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos PrestamoBackup comenzando por $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup terminando por $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup terminando por $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup que contenga $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup que contenga $prestamoComentariosBackup
         * 
         * @param $prestamoComentariosBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if( !(EntityValidator::validateString($prestamoComentariosBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado $prestamoEstudianteBackup
         * 
         * @param $prestamoEstudianteBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if( !(EntityValidator::validateNumber($prestamoEstudianteBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup );
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado $prestamoEstudianteBackup
         * 
         * @param $prestamoEstudianteBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if( !(EntityValidator::validateNumber($prestamoEstudianteBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 140);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 142);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 144);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 141);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 143);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 145);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado $prestamoComputadoraBackup
         * 
         * @param $prestamoComputadoraBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 146);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 148);
            }

            if( !(EntityValidator::validateNumber($prestamoComputadoraBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 150);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup );
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado $prestamoComputadoraBackup
         * 
         * @param $prestamoComputadoraBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 147);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 149);
            }

            if( !(EntityValidator::validateNumber($prestamoComputadoraBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 151);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 152);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 154);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 156);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 153);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 155);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 157);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 164);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 166);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 168);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 165);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 167);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 169);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado $prestamoBackupFechaBackup
         * 
         * @param $prestamoBackupFechaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 170);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 172);
            }

            if( !(EntityValidator::validateDate($prestamoBackupFechaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 174);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup );
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado $prestamoBackupFechaBackup
         * 
         * @param $prestamoBackupFechaBackup
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 171);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 173);
            }

            if( !(EntityValidator::validateDate($prestamoBackupFechaBackup))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 175);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 176);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 178);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 180);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 177);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 179);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 181);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 188);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 190);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 192);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->getPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos PrestamoBackup dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 189);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 191);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 193);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBackupBean->countGetPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value);
            }

            return PrestamoBackupDTO::loadFromEntities($this->prestamoBackupBean->listPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }


        /**
         * Eliminar un PrestamoBackup Dado el $prestamoBackupId
         * 
         * @param $prestamoBackupId
        */
        public function removePrestamoBackup($prestamoBackupId){

            $prestamoBackup = new PrestamoBackup();
            $prestamoBackup->setId($prestamoBackupId); 

            # Validamos los campos
            if( !EntityValidator::validateId($prestamoBackupId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 194);
            }

            # Verificamos que la entidad exista.
            if(!$this->prestamoBackupBean->getPrestamoBackup($prestamoBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 195);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->prestamoBackupBean->removePrestamoBackup($prestamoBackup)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 196);
            }

        }

    }

?>