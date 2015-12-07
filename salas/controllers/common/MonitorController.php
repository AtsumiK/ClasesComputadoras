<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.ESTUDIANTE_BEAN;
    require_once SALAS_COMP_BEANS_DIR.TAREA_BEAN;
    require_once SALAS_COMP_BEANS_DIR.MONITOR_SALON_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.MONITOR_BEAN;

    

    class MonitorController {

        private $ID = 11000;

        private $persistenceManager;
        private $lastRequestSize;

        private $monitorBean;

        function MonitorController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->monitorBean = new MonitorBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Monitor al sistema.
         * 
         * @param MonitorDTO $monitorDTO
        */
        public function setMonitor(MonitorDTO &$monitorDTO){
            $monitor = MonitorDTO::toEntity($monitorDTO);
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();

            # Validamos los campos
            if(!$monitor->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 1);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($monitor->getMonitorEstudiante() !== null){
                $estudiante->setId($monitor->getMonitorEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            # Almacenamos la entidad
            if(!$this->monitorBean->setMonitor($monitor)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 2);
            }

            $monitorDTO->loadFromEntity($monitor);
        }
        /**
         * Actualizar Monitor al sistema.
         * 
         * @param MonitorDTO $monitorDTO
        */
        public function updateMonitor(MonitorDTO &$monitorDTO){
            $monitor = MonitorDTO::toEntity($monitorDTO);
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();

            # Validamos los campos
            if(!$monitor->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($monitor->getMonitorEstudiante() !== null){
                $estudiante->setId($monitor->getMonitorEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 3);
                }
            }

            # Actualizamos la entidad
            if(!$this->monitorBean->updateMonitor($monitor)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 5);
            }

            $monitorDTO->loadFromEntity($monitor);
        }
        /**
         * Obtener un Monitor único.
         * 
         * @param MonitorDTO &$monitorDTO
        */

        public function getMonitor(MonitorDTO &$monitorDTO){

            $monitor = MonitorDTO::toEntity($monitorDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($monitor->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Obtenemos la entidad
            if(!$this->monitorBean->getMonitor($monitor)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 7);
            }

            $monitorDTO->loadFromEntity($monitor);
        }
        /**
         * Obtener todos los Monitor
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getMonitors($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countAllMonitors();
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getAllMonitors($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Monitor
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listMonitors($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countAllMonitors();
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listAllMonitors($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Monitor dado $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorTipo($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipo($monitorTipo );
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorTipo($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorTipo($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipo($monitorTipo);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorTipo($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorTipoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoBetween($firstValue, $secondValue);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorTipoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorTipoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoBetween($firstValue, $secondValue);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorTipoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorTipoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoBiggerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorTipoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorTipoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoBiggerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorTipoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorTipoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoLowerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorTipoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorTipoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoLowerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorTipoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Monitor comenzando por $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorTipoBeginsWith($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoBeginsWith($monitorTipo);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorTipoBeginsWith($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Monitor comenzando por $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorTipoBeginsWith($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoBeginsWith($monitorTipo);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorTipoBeginsWith($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor terminando por $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorTipoEndsWith($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoEndsWith($monitorTipo);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorTipoEndsWith($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor terminando por $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorTipoEndsWith($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoEndsWith($monitorTipo);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorTipoEndsWith($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor que contenga $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorTipoContains($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoContains($monitorTipo);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorTipoContains($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor que contenga $monitorTipo
         * 
         * @param $monitorTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorTipoContains($monitorTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if( !(EntityValidator::validateString($monitorTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorTipoContains($monitorTipo);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorTipoContains($monitorTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorHorario($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorario($monitorHorario );
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorHorario($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorHorario($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorario($monitorHorario);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorHorario($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorHorarioBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioBetween($firstValue, $secondValue);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorHorarioBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorHorarioBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioBetween($firstValue, $secondValue);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorHorarioBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorHorarioBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioBiggerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorHorarioBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorHorarioBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioBiggerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorHorarioBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorHorarioLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioLowerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorHorarioLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorHorarioLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioLowerThan($value);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorHorarioLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Monitor comenzando por $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorHorarioBeginsWith($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioBeginsWith($monitorHorario);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorHorarioBeginsWith($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Monitor comenzando por $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorHorarioBeginsWith($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioBeginsWith($monitorHorario);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorHorarioBeginsWith($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor terminando por $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorHorarioEndsWith($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioEndsWith($monitorHorario);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorHorarioEndsWith($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor terminando por $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorHorarioEndsWith($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioEndsWith($monitorHorario);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorHorarioEndsWith($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor que contenga $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorHorarioContains($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioContains($monitorHorario);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorHorarioContains($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor que contenga $monitorHorario
         * 
         * @param $monitorHorario
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorHorarioContains($monitorHorario, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if( !(EntityValidator::validateString($monitorHorario))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorHorarioContains($monitorHorario);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorHorarioContains($monitorHorario, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Monitor dado el $monitorEstudianteId
         * 
         * @param $monitorEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorsByMonitorEstudianteId($monitorEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($monitorEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if( !EntityValidator::validateId($monitorEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 100);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorEstudiante($obj);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->getMonitorsByMonitorEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Monitor dado el $monitorEstudianteId
         * 
         * @param $monitorEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorsByMonitorEstudianteId($monitorEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($monitorEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if( !EntityValidator::validateId($monitorEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 101);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorBean->countGetMonitorsByMonitorEstudiante($obj);
            }

            return MonitorDTO::loadFromEntities($this->monitorBean->listMonitorsByMonitorEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un Monitor Dado el $monitorId
         * 
         * @param $monitorId
        */
        public function removeMonitor($monitorId){
            $tareaBean = new TareaBean($this->persistenceManager);
            $monitorSalonBean = new MonitorSalonBean($this->persistenceManager);

            $monitor = new Monitor();
            $monitor->setId($monitorId); 

            # Validamos los campos
            if( !EntityValidator::validateId($monitorId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            # Verificamos que la entidad exista.
            if(!$this->monitorBean->getMonitor($monitor)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 105);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Verificamos que la entidad no esté siendo utilziada en Tarea->tareaMonitor
            $tareas = $tareaBean->getTareasByTareaMonitor($monitor);
            if(count($tareas) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 102);
            }

            # Verificamos que la entidad no esté siendo utilziada en MonitorSalon->monitor
            $monitorSalons = $monitorSalonBean->getMonitorSalonsByMonitor($monitor);
            if(count($monitorSalons) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 103);
            }

            # Eliminamos la entidad
            if(!$this->monitorBean->removeMonitor($monitor)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 106);
            }

        }

    }

?>