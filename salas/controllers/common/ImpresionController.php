<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.ESTUDIANTE_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.IMPRESION_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.IMPRESION_BEAN;

    

    class ImpresionController {

        private $ID = 10000;

        private $persistenceManager;
        private $lastRequestSize;

        private $impresionBean;

        function ImpresionController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->impresionBean = new ImpresionBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Impresion al sistema.
         * 
         * @param ImpresionDTO $impresionDTO
        */
        public function setImpresion(ImpresionDTO &$impresionDTO){
            $impresion = ImpresionDTO::toEntity($impresionDTO);
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();

            # Validamos los campos
            if(!$impresion->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 1);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($impresion->getImpresionEstudiante() !== null){
                $estudiante->setId($impresion->getImpresionEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            # Almacenamos la entidad
            if(!$this->impresionBean->setImpresion($impresion)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 2);
            }

            $impresionDTO->loadFromEntity($impresion);
        }
        /**
         * Actualizar Impresion al sistema.
         * 
         * @param ImpresionDTO $impresionDTO
        */
        public function updateImpresion(ImpresionDTO &$impresionDTO){
            $impresion = ImpresionDTO::toEntity($impresionDTO);
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();

            # Validamos los campos
            if(!$impresion->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($impresion->getImpresionEstudiante() !== null){
                $estudiante->setId($impresion->getImpresionEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 3);
                }
            }

            # Actualizamos la entidad
            if(!$this->impresionBean->updateImpresion($impresion)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 5);
            }

            $impresionDTO->loadFromEntity($impresion);
        }
        /**
         * Obtener un Impresion único.
         * 
         * @param ImpresionDTO &$impresionDTO
        */

        public function getImpresion(ImpresionDTO &$impresionDTO){

            $impresion = ImpresionDTO::toEntity($impresionDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($impresion->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Obtenemos la entidad
            if(!$this->impresionBean->getImpresion($impresion)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 7);
            }

            $impresionDTO->loadFromEntity($impresion);
        }
        /**
         * Obtener todos los Impresion
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getImpresions($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countAllImpresions();
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getAllImpresions($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Impresion
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listImpresions($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countAllImpresions();
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listAllImpresions($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Impresion dado $impresionFecha
         * 
         * @param $impresionFecha
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionFecha($impresionFecha, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if( !(EntityValidator::validateDate($impresionFecha))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFecha($impresionFecha );
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionFecha($impresionFecha, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado $impresionFecha
         * 
         * @param $impresionFecha
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionFecha($impresionFecha, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if( !(EntityValidator::validateDate($impresionFecha))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFecha($impresionFecha);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionFecha($impresionFecha, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionFechaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 18);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 20);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFechaBetween($firstValue, $secondValue);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionFechaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionFechaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 19);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 21);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFechaBetween($firstValue, $secondValue);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionFechaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionFechaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 22);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 24);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 26);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFechaBiggerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionFechaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionFechaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 23);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 25);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 27);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFechaBiggerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionFechaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionFechaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 28);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 30);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFechaLowerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionFechaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionFechaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 29);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 31);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionFechaLowerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionFechaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionLugar($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugar($impresionLugar );
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionLugar($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionLugar($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugar($impresionLugar);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionLugar($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionLugarBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarBetween($firstValue, $secondValue);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionLugarBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionLugarBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarBetween($firstValue, $secondValue);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionLugarBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionLugarBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarBiggerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionLugarBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionLugarBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarBiggerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionLugarBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionLugarLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarLowerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionLugarLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionLugarLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarLowerThan($value);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionLugarLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Impresion comenzando por $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionLugarBeginsWith($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarBeginsWith($impresionLugar);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionLugarBeginsWith($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Impresion comenzando por $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionLugarBeginsWith($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarBeginsWith($impresionLugar);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionLugarBeginsWith($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion terminando por $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionLugarEndsWith($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarEndsWith($impresionLugar);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionLugarEndsWith($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion terminando por $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionLugarEndsWith($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarEndsWith($impresionLugar);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionLugarEndsWith($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion que contenga $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionLugarContains($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarContains($impresionLugar);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionLugarContains($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion que contenga $impresionLugar
         * 
         * @param $impresionLugar
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionLugarContains($impresionLugar, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            if( !(EntityValidator::validateString($impresionLugar))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionLugarContains($impresionLugar);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionLugarContains($impresionLugar, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Impresion dado el $impresionEstudianteId
         * 
         * @param $impresionEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getImpresionsByImpresionEstudianteId($impresionEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($impresionEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if( !EntityValidator::validateId($impresionEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 82);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionEstudiante($obj);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->getImpresionsByImpresionEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Impresion dado el $impresionEstudianteId
         * 
         * @param $impresionEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listImpresionsByImpresionEstudianteId($impresionEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($impresionEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if( !EntityValidator::validateId($impresionEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 83);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->impresionBean->countGetImpresionsByImpresionEstudiante($obj);
            }

            return ImpresionDTO::loadFromEntities($this->impresionBean->listImpresionsByImpresionEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un Impresion Dado el $impresionId
         * 
         * @param $impresionId
        */
        public function removeImpresion($impresionId){

            $impresion = new Impresion();
            $impresion->setId($impresionId); 

            # Validamos los campos
            if( !EntityValidator::validateId($impresionId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            # Verificamos que la entidad exista.
            if(!$this->impresionBean->getImpresion($impresion)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 85);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->impresionBean->removeImpresion($impresion)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 86);
            }

        }

    }

?>