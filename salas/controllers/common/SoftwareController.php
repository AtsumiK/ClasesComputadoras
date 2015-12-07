<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_BEANS_DIR.COMPUTADORA_SOFTWARE_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SOFTWARE_BEAN;

    

    class SoftwareController {

        private $ID = 1000;

        private $persistenceManager;
        private $lastRequestSize;

        private $softwareBean;

        function SoftwareController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->softwareBean = new SoftwareBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Software al sistema.
         * 
         * @param SoftwareDTO $softwareDTO
        */
        public function setSoftware(SoftwareDTO &$softwareDTO){
            $software = SoftwareDTO::toEntity($softwareDTO);

            # Validamos los campos
            if(!$software->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->softwareBean->setSoftware($software)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $softwareDTO->loadFromEntity($software);
        }
        /**
         * Actualizar Software al sistema.
         * 
         * @param SoftwareDTO $softwareDTO
        */
        public function updateSoftware(SoftwareDTO &$softwareDTO){
            $software = SoftwareDTO::toEntity($softwareDTO);

            # Validamos los campos
            if(!$software->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->softwareBean->updateSoftware($software)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $softwareDTO->loadFromEntity($software);
        }
        /**
         * Obtener un Software único.
         * 
         * @param SoftwareDTO &$softwareDTO
        */

        public function getSoftware(SoftwareDTO &$softwareDTO){

            $software = SoftwareDTO::toEntity($softwareDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($software->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->softwareBean->getSoftware($software)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $softwareDTO->loadFromEntity($software);
        }
        /**
         * Obtener todos los Software
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getSoftwares($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countAllSoftwares();
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getAllSoftwares($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Software
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listSoftwares($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countAllSoftwares();
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listAllSoftwares($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Software dado $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie );
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNumeroSerieBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNumeroSerieBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNumeroSerieBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNumeroSerieBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNumeroSerieLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNumeroSerieLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNumeroSerieLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNumeroSerieLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Software comenzando por $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Software comenzando por $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software terminando por $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software terminando por $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software que contenga $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software que contenga $softwareNumeroSerie
         * 
         * @param $softwareNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if( !(EntityValidator::validateString($softwareNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNombre($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombre($softwareNombre );
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNombre($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNombre($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombre($softwareNombre);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNombre($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNombreBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNombreBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNombreBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNombreBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNombreBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNombreBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNombreBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNombreBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNombreLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNombreLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNombreLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNombreLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Software comenzando por $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNombreBeginsWith($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreBeginsWith($softwareNombre);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNombreBeginsWith($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Software comenzando por $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNombreBeginsWith($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreBeginsWith($softwareNombre);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNombreBeginsWith($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software terminando por $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNombreEndsWith($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreEndsWith($softwareNombre);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNombreEndsWith($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software terminando por $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNombreEndsWith($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreEndsWith($softwareNombre);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNombreEndsWith($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software que contenga $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareNombreContains($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreContains($softwareNombre);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareNombreContains($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software que contenga $softwareNombre
         * 
         * @param $softwareNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareNombreContains($softwareNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if( !(EntityValidator::validateString($softwareNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareNombreContains($softwareNombre);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareNombreContains($softwareNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareVersion($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersion($softwareVersion );
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareVersion($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareVersion($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersion($softwareVersion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareVersion($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareVersionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareVersionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareVersionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareVersionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareVersionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareVersionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareVersionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareVersionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareVersionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareVersionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareVersionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareVersionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Software comenzando por $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareVersionBeginsWith($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionBeginsWith($softwareVersion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareVersionBeginsWith($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Software comenzando por $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareVersionBeginsWith($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionBeginsWith($softwareVersion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareVersionBeginsWith($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software terminando por $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareVersionEndsWith($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionEndsWith($softwareVersion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareVersionEndsWith($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software terminando por $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareVersionEndsWith($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionEndsWith($softwareVersion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareVersionEndsWith($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software que contenga $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareVersionContains($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionContains($softwareVersion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareVersionContains($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software que contenga $softwareVersion
         * 
         * @param $softwareVersion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareVersionContains($softwareVersion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if( !(EntityValidator::validateString($softwareVersion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareVersionContains($softwareVersion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareVersionContains($softwareVersion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado $softwareFechaCaducidad
         * 
         * @param $softwareFechaCaducidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 136);
            }

            if( !(EntityValidator::validateDate($softwareFechaCaducidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 138);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad );
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado $softwareFechaCaducidad
         * 
         * @param $softwareFechaCaducidad
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 135);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 137);
            }

            if( !(EntityValidator::validateDate($softwareFechaCaducidad))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 139);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 140);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 142);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 144);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 141);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 143);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 145);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaCaducidadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 146);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 148);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 150);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidadBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaCaducidadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaCaducidadBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 147);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 149);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 151);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidadBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaCaducidadBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaCaducidadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 152);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 154);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 156);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidadLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaCaducidadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaCaducidadLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 153);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 155);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 157);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaCaducidadLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaCaducidadLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado $softwareFechaAquisicion
         * 
         * @param $softwareFechaAquisicion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 158);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 160);
            }

            if( !(EntityValidator::validateDate($softwareFechaAquisicion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 162);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion );
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado $softwareFechaAquisicion
         * 
         * @param $softwareFechaAquisicion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 159);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 161);
            }

            if( !(EntityValidator::validateDate($softwareFechaAquisicion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 163);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 164);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 166);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 168);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 165);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 167);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 169);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaAquisicionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 170);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 172);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 174);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicionBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaAquisicionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaAquisicionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 171);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 173);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 175);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicionBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaAquisicionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareFechaAquisicionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicionLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareFechaAquisicionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareFechaAquisicionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareFechaAquisicionLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareFechaAquisicionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado $softwareEquiposPermitidos
         * 
         * @param $softwareEquiposPermitidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 182);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 184);
            }

            if( !(EntityValidator::validateNumber($softwareEquiposPermitidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 186);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos );
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado $softwareEquiposPermitidos
         * 
         * @param $softwareEquiposPermitidos
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 183);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 185);
            }

            if( !(EntityValidator::validateNumber($softwareEquiposPermitidos))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 187);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 188);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 190);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 192);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 189);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 191);
            }

            if( !(EntityValidator::validateNumber($firstValue) && EntityValidator::validateNumber($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 193);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareEquiposPermitidosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 194);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 196);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 198);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidosBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareEquiposPermitidosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareEquiposPermitidosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 195);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 197);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 199);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidosBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareEquiposPermitidosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareEquiposPermitidosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 200);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 202);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 204);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidosLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareEquiposPermitidosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareEquiposPermitidosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 201);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 203);
            }

            if( !(EntityValidator::validateNumber($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 205);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareEquiposPermitidosLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareEquiposPermitidosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareComentarios($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 206);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 208);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 210);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentarios($softwareComentarios );
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareComentarios($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareComentarios($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 207);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 209);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 211);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentarios($softwareComentarios);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareComentarios($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 212);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 214);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 216);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 213);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 215);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 217);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 218);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 220);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 222);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 219);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 221);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 223);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosBiggerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 224);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 226);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 228);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 225);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 227);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 229);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosLowerThan($value);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Software comenzando por $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 230);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 232);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 234);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Software comenzando por $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 231);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 233);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 235);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software terminando por $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareComentariosEndsWith($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 236);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 238);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 240);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosEndsWith($softwareComentarios);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareComentariosEndsWith($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software terminando por $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareComentariosEndsWith($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 237);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 239);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 241);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosEndsWith($softwareComentarios);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareComentariosEndsWith($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Software que contenga $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSoftwaresBySoftwareComentariosContains($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 242);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 244);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 246);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosContains($softwareComentarios);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->getSoftwaresBySoftwareComentariosContains($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Software que contenga $softwareComentarios
         * 
         * @param $softwareComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSoftwaresBySoftwareComentariosContains($softwareComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 243);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 245);
            }

            if( !(EntityValidator::validateString($softwareComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 247);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->softwareBean->countGetSoftwaresBySoftwareComentariosContains($softwareComentarios);
            }

            return SoftwareDTO::loadFromEntities($this->softwareBean->listSoftwaresBySoftwareComentariosContains($softwareComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }


        /**
         * Eliminar un Software Dado el $softwareId
         * 
         * @param $softwareId
        */
        public function removeSoftware($softwareId){
            $computadoraSoftwareBean = new ComputadoraSoftwareBean($this->persistenceManager);

            $software = new Software();
            $software->setId($softwareId); 

            # Validamos los campos
            if( !EntityValidator::validateId($softwareId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 249);
            }

            # Verificamos que la entidad exista.
            if(!$this->softwareBean->getSoftware($software)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 250);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Verificamos que la entidad no esté siendo utilziada en ComputadoraSoftware->software
            $computadoraSoftwares = $computadoraSoftwareBean->getComputadoraSoftwaresBySoftware($software);
            if(count($computadoraSoftwares) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 248);
            }

            # Eliminamos la entidad
            if(!$this->softwareBean->removeSoftware($software)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 251);
            }

        }

    }

?>