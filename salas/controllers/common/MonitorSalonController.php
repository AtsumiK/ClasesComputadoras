<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.MONITOR_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SALON_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_SALON_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.MONITOR_SALON_BEAN;



    class MonitorSalonController {

        private $ID = 9000;

        private $persistenceManager;
        private $lastRequestSize;

        private $monitorSalonBean;

        function MonitorSalonController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->monitorSalonBean = new MonitorSalonBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar MonitorSalon al sistema.
         *
         * @param MonitorSalonDTO $monitorSalonDTO
        */
        public function setMonitorSalon(MonitorSalonDTO &$monitorSalonDTO){
            $monitorSalon = MonitorSalonDTO::toEntity($monitorSalonDTO);
            $monitorBean = new MonitorBean($this->persistenceManager);
            $monitor = new Monitor();
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();

            # Validamos los campos
            if(!$monitorSalon->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($monitorSalon->getMonitor() !== null){
                $monitor->setId($monitorSalon->getMonitor());
                if(!$monitorBean->getMonitor($monitor)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            if($monitorSalon->getSalon() !== null){
                $salon->setId($monitorSalon->getSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 1);
                }
            }

            # Almacenamos la entidad
            if(!$this->monitorSalonBean->setMonitorSalon($monitorSalon)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 3);
            }

            $monitorSalonDTO->loadFromEntity($monitorSalon);
        }
        /**
         * Actualizar MonitorSalon al sistema.
         *
         * @param MonitorSalonDTO $monitorSalonDTO
        */
        public function updateMonitorSalon(MonitorSalonDTO &$monitorSalonDTO){
            $monitorSalon = MonitorSalonDTO::toEntity($monitorSalonDTO);
            $monitorBean = new MonitorBean($this->persistenceManager);
            $monitor = new Monitor();
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();

            # Validamos los campos
            if(!$monitorSalon->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($monitorSalon->getMonitor() !== null){
                $monitor->setId($monitorSalon->getMonitor());
                if(!$monitorBean->getMonitor($monitor)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 4);
                }
            }

            if($monitorSalon->getSalon() !== null){
                $salon->setId($monitorSalon->getSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 5);
                }
            }

            # Actualizamos la entidad
            if(!$this->monitorSalonBean->updateMonitorSalon($monitorSalon)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 7);
            }

            $monitorSalonDTO->loadFromEntity($monitorSalon);
        }
        /**
         * Obtener un MonitorSalon único.
         *
         * @param MonitorSalonDTO &$monitorSalonDTO
        */

        public function getMonitorSalon(MonitorSalonDTO &$monitorSalonDTO){

            $monitorSalon = MonitorSalonDTO::toEntity($monitorSalonDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($monitorSalon->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            # Obtenemos la entidad
            if(!$this->monitorSalonBean->getMonitorSalon($monitorSalon)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 9);
            }

            $monitorSalonDTO->loadFromEntity($monitorSalon);
        }
        /**
         * Obtener todos los MonitorSalon
         *
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getMonitorSalons($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countAllMonitorSalons();
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getAllMonitorSalons($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los MonitorSalon
         *
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listMonitorSalons($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countAllMonitorSalons();
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listAllMonitorSalons($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos MonitorSalon dado $monitorSalonEntrada
         *
         * @param $monitorSalonEntrada
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if( !(EntityValidator::validateDate($monitorSalonEntrada))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada );
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado $monitorSalonEntrada
         *
         * @param $monitorSalonEntrada
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if( !(EntityValidator::validateDate($monitorSalonEntrada))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 18);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 20);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 22);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 19);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 21);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 23);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonEntradaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 24);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 26);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 28);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntradaBiggerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonEntradaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonEntradaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 25);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 27);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 29);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntradaBiggerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonEntradaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonEntradaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 30);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntradaLowerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonEntradaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonEntradaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 31);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonEntradaLowerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonEntradaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado $monitorSalonSalida
         *
         * @param $monitorSalonSalida
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonSalida($monitorSalonSalida, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if( !(EntityValidator::validateDate($monitorSalonSalida))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalida($monitorSalonSalida );
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonSalida($monitorSalonSalida, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado $monitorSalonSalida
         *
         * @param $monitorSalonSalida
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonSalida($monitorSalonSalida, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if( !(EntityValidator::validateDate($monitorSalonSalida))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalida($monitorSalonSalida);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonSalida($monitorSalonSalida, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonSalidaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalidaBiggerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonSalidaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonSalidaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalidaBiggerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonSalidaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonSalidaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalidaLowerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonSalidaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonSalidaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonSalidaLowerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonSalidaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios );
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosBiggerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosBiggerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosLowerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosLowerThan($value);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos MonitorSalon comenzando por $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos MonitorSalon comenzando por $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon terminando por $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon terminando por $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon que contenga $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon que contenga $monitorSalonComentarios
         *
         * @param $monitorSalonComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if( !(EntityValidator::validateString($monitorSalonComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos MonitorSalon dado el $monitorId
         *
         * @param $monitorId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsByMonitorId($monitorId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new MonitorBean($this->persistenceManager);
            $obj = new Monitor();
            $obj->setId($monitorId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if( !EntityValidator::validateId($monitorId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getMonitor($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 108);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitor($obj);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsByMonitor($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado el $monitorId
         *
         * @param $monitorId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsByMonitorId($monitorId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new MonitorBean($this->persistenceManager);
            $obj = new Monitor();
            $obj->setId($monitorId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if( !EntityValidator::validateId($monitorId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getMonitor($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 109);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsByMonitor($obj);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsByMonitor($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }
        /**
         * Obtener algunos MonitorSalon dado el $salonId
         *
         * @param $salonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getMonitorSalonsBySalonId($salonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($salonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if( !EntityValidator::validateId($salonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 116);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsBySalon($obj);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->getMonitorSalonsBySalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos MonitorSalon dado el $salonId
         *
         * @param $salonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listMonitorSalonsBySalonId($salonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($salonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if( !EntityValidator::validateId($salonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 117);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->monitorSalonBean->countGetMonitorSalonsBySalon($obj);
            }

            return MonitorSalonDTO::loadFromEntities($this->monitorSalonBean->listMonitorSalonsBySalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un MonitorSalon Dado el $monitorSalonId
         *
         * @param $monitorSalonId
        */
        public function removeMonitorSalon($monitorSalonId){

            $monitorSalon = new MonitorSalon();
            $monitorSalon->setId($monitorSalonId);

            # Validamos los campos
            if( !EntityValidator::validateId($monitorSalonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            # Verificamos que la entidad exista.
            if(!$this->monitorSalonBean->getMonitorSalon($monitorSalon)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 119);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->monitorSalonBean->removeMonitorSalon($monitorSalon)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 120);
            }

        }

    }

?>
