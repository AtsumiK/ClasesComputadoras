<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.MONITOR_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.TAREA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.TAREA_BEAN;

    

    class TareaController {

        private $ID = 6000;

        private $persistenceManager;
        private $lastRequestSize;

        private $tareaBean;

        function TareaController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->tareaBean = new TareaBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Tarea al sistema.
         * 
         * @param TareaDTO $tareaDTO
        */
        public function setTarea(TareaDTO &$tareaDTO){
            $tarea = TareaDTO::toEntity($tareaDTO);
            $monitorBean = new MonitorBean($this->persistenceManager);
            $monitor = new Monitor();

            # Validamos los campos
            if(!$tarea->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 1);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($tarea->getTareaMonitor() !== null){
                $monitor->setId($tarea->getTareaMonitor());
                if(!$monitorBean->getMonitor($monitor)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            # Almacenamos la entidad
            if(!$this->tareaBean->setTarea($tarea)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 2);
            }

            $tareaDTO->loadFromEntity($tarea);
        }
        /**
         * Actualizar Tarea al sistema.
         * 
         * @param TareaDTO $tareaDTO
        */
        public function updateTarea(TareaDTO &$tareaDTO){
            $tarea = TareaDTO::toEntity($tareaDTO);
            $monitorBean = new MonitorBean($this->persistenceManager);
            $monitor = new Monitor();

            # Validamos los campos
            if(!$tarea->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($tarea->getTareaMonitor() !== null){
                $monitor->setId($tarea->getTareaMonitor());
                if(!$monitorBean->getMonitor($monitor)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 3);
                }
            }

            # Actualizamos la entidad
            if(!$this->tareaBean->updateTarea($tarea)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 5);
            }

            $tareaDTO->loadFromEntity($tarea);
        }
        /**
         * Obtener un Tarea único.
         * 
         * @param TareaDTO &$tareaDTO
        */

        public function getTarea(TareaDTO &$tareaDTO){

            $tarea = TareaDTO::toEntity($tareaDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($tarea->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Obtenemos la entidad
            if(!$this->tareaBean->getTarea($tarea)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 7);
            }

            $tareaDTO->loadFromEntity($tarea);
        }
        /**
         * Obtener todos los Tarea
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getTareas($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countAllTareas();
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getAllTareas($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Tarea
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listTareas($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countAllTareas();
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listAllTareas($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Tarea dado $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaDescripcion($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcion($tareaDescripcion );
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaDescripcion($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaDescripcion($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcion($tareaDescripcion);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaDescripcion($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaDescripcionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaDescripcionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaDescripcionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaDescripcionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaDescripcionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaDescripcionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaDescripcionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaDescripcionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaDescripcionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaDescripcionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaDescripcionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaDescripcionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Tarea comenzando por $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaDescripcionBeginsWith($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionBeginsWith($tareaDescripcion);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaDescripcionBeginsWith($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Tarea comenzando por $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaDescripcionBeginsWith($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionBeginsWith($tareaDescripcion);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaDescripcionBeginsWith($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea terminando por $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaDescripcionEndsWith($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionEndsWith($tareaDescripcion);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaDescripcionEndsWith($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea terminando por $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaDescripcionEndsWith($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionEndsWith($tareaDescripcion);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaDescripcionEndsWith($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea que contenga $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaDescripcionContains($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionContains($tareaDescripcion);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaDescripcionContains($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea que contenga $tareaDescripcion
         * 
         * @param $tareaDescripcion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaDescripcionContains($tareaDescripcion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if( !(EntityValidator::validateString($tareaDescripcion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaDescripcionContains($tareaDescripcion);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaDescripcionContains($tareaDescripcion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaComentarios($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentarios($tareaComentarios );
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaComentarios($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaComentarios($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentarios($tareaComentarios);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaComentarios($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Tarea comenzando por $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaComentariosBeginsWith($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosBeginsWith($tareaComentarios);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaComentariosBeginsWith($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Tarea comenzando por $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaComentariosBeginsWith($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosBeginsWith($tareaComentarios);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaComentariosBeginsWith($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea terminando por $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaComentariosEndsWith($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosEndsWith($tareaComentarios);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaComentariosEndsWith($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea terminando por $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaComentariosEndsWith($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosEndsWith($tareaComentarios);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaComentariosEndsWith($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea que contenga $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaComentariosContains($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosContains($tareaComentarios);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaComentariosContains($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea que contenga $tareaComentarios
         * 
         * @param $tareaComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaComentariosContains($tareaComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if( !(EntityValidator::validateString($tareaComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaComentariosContains($tareaComentarios);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaComentariosContains($tareaComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado $tareaFechaInicio
         * 
         * @param $tareaFechaInicio
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaInicio($tareaFechaInicio, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if( !(EntityValidator::validateDate($tareaFechaInicio))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicio($tareaFechaInicio );
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaInicio($tareaFechaInicio, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado $tareaFechaInicio
         * 
         * @param $tareaFechaInicio
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaInicio($tareaFechaInicio, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if( !(EntityValidator::validateDate($tareaFechaInicio))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicio($tareaFechaInicio);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaInicio($tareaFechaInicio, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaInicioBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicioBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaInicioBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaInicioBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicioBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaInicioBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaInicioBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicioBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaInicioBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaInicioBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicioBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaInicioBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaInicioLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicioLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaInicioLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaInicioLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaInicioLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaInicioLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado $tareaFechaFin
         * 
         * @param $tareaFechaFin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaFin($tareaFechaFin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            if( !(EntityValidator::validateDate($tareaFechaFin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFin($tareaFechaFin );
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaFin($tareaFechaFin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado $tareaFechaFin
         * 
         * @param $tareaFechaFin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaFin($tareaFechaFin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            if( !(EntityValidator::validateDate($tareaFechaFin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFin($tareaFechaFin);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaFin($tareaFechaFin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaFinBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFinBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaFinBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaFinBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFinBetween($firstValue, $secondValue);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaFinBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaFinBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFinBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaFinBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaFinBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 135);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFinBiggerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaFinBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaFechaFinLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 136);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 138);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 140);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFinLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaFechaFinLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaFechaFinLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 137);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 139);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 141);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaFechaFinLowerThan($value);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaFechaFinLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Tarea dado el $tareaMonitorId
         * 
         * @param $tareaMonitorId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getTareasByTareaMonitorId($tareaMonitorId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new MonitorBean($this->persistenceManager);
            $obj = new Monitor();
            $obj->setId($tareaMonitorId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 142);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 144);
            }

            if( !EntityValidator::validateId($tareaMonitorId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 146);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getMonitor($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 148);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaMonitor($obj);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->getTareasByTareaMonitor($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Tarea dado el $tareaMonitorId
         * 
         * @param $tareaMonitorId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listTareasByTareaMonitorId($tareaMonitorId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new MonitorBean($this->persistenceManager);
            $obj = new Monitor();
            $obj->setId($tareaMonitorId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 143);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 145);
            }

            if( !EntityValidator::validateId($tareaMonitorId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 147);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getMonitor($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 149);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->tareaBean->countGetTareasByTareaMonitor($obj);
            }

            return TareaDTO::loadFromEntities($this->tareaBean->listTareasByTareaMonitor($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un Tarea Dado el $tareaId
         * 
         * @param $tareaId
        */
        public function removeTarea($tareaId){

            $tarea = new Tarea();
            $tarea->setId($tareaId); 

            # Validamos los campos
            if( !EntityValidator::validateId($tareaId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 150);
            }

            # Verificamos que la entidad exista.
            if(!$this->tareaBean->getTarea($tarea)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 151);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->tareaBean->removeTarea($tarea)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 152);
            }

        }

    }

?>