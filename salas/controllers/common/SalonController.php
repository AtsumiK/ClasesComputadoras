<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_BEANS_DIR.OBJETO_EN_INVENTARIO_BEAN;
    require_once SALAS_COMP_BEANS_DIR.OBJETO_PERDIDO_BEAN;
    require_once SALAS_COMP_BEANS_DIR.MONITOR_SALON_BEAN;
    require_once SALAS_COMP_BEANS_DIR.RESERVA_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SALON_BEAN;

    

    class SalonController {

        private $ID = 7000;

        private $persistenceManager;
        private $lastRequestSize;

        private $salonBean;

        function SalonController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->salonBean = new SalonBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Salon al sistema.
         * 
         * @param SalonDTO $salonDTO
        */
        public function setSalon(SalonDTO &$salonDTO){
            $salon = SalonDTO::toEntity($salonDTO);

            # Validamos los campos
            if(!$salon->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->salonBean->setSalon($salon)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $salonDTO->loadFromEntity($salon);
        }
        /**
         * Actualizar Salon al sistema.
         * 
         * @param SalonDTO $salonDTO
        */
        public function updateSalon(SalonDTO &$salonDTO){
            $salon = SalonDTO::toEntity($salonDTO);

            # Validamos los campos
            if(!$salon->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->salonBean->updateSalon($salon)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $salonDTO->loadFromEntity($salon);
        }
        /**
         * Obtener un Salon único.
         * 
         * @param SalonDTO &$salonDTO
        */

        public function getSalon(SalonDTO &$salonDTO){

            $salon = SalonDTO::toEntity($salonDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($salon->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->salonBean->getSalon($salon)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $salonDTO->loadFromEntity($salon);
        }
        /**
         * Obtener todos los Salon
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getSalons($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->salonBean->countAllSalons();
            }

            return SalonDTO::loadFromEntities($this->salonBean->getAllSalons($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Salon
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listSalons($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->salonBean->countAllSalons();
            }

            return SalonDTO::loadFromEntities($this->salonBean->listAllSalons($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Salon dado $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSalonsBySalonNombre($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombre($salonNombre );
            }

            return SalonDTO::loadFromEntities($this->salonBean->getSalonsBySalonNombre($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Salon dado $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSalonsBySalonNombre($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombre($salonNombre);
            }

            return SalonDTO::loadFromEntities($this->salonBean->listSalonsBySalonNombre($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Salon dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSalonsBySalonNombreBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreBetween($firstValue, $secondValue);
            }

            return SalonDTO::loadFromEntities($this->salonBean->getSalonsBySalonNombreBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Salon dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSalonsBySalonNombreBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreBetween($firstValue, $secondValue);
            }

            return SalonDTO::loadFromEntities($this->salonBean->listSalonsBySalonNombreBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Salon dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSalonsBySalonNombreBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreBiggerThan($value);
            }

            return SalonDTO::loadFromEntities($this->salonBean->getSalonsBySalonNombreBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Salon dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSalonsBySalonNombreBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreBiggerThan($value);
            }

            return SalonDTO::loadFromEntities($this->salonBean->listSalonsBySalonNombreBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Salon dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSalonsBySalonNombreLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreLowerThan($value);
            }

            return SalonDTO::loadFromEntities($this->salonBean->getSalonsBySalonNombreLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Salon dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSalonsBySalonNombreLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreLowerThan($value);
            }

            return SalonDTO::loadFromEntities($this->salonBean->listSalonsBySalonNombreLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Salon comenzando por $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSalonsBySalonNombreBeginsWith($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreBeginsWith($salonNombre);
            }

            return SalonDTO::loadFromEntities($this->salonBean->getSalonsBySalonNombreBeginsWith($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Salon comenzando por $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSalonsBySalonNombreBeginsWith($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreBeginsWith($salonNombre);
            }

            return SalonDTO::loadFromEntities($this->salonBean->listSalonsBySalonNombreBeginsWith($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Salon terminando por $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSalonsBySalonNombreEndsWith($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreEndsWith($salonNombre);
            }

            return SalonDTO::loadFromEntities($this->salonBean->getSalonsBySalonNombreEndsWith($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Salon terminando por $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSalonsBySalonNombreEndsWith($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreEndsWith($salonNombre);
            }

            return SalonDTO::loadFromEntities($this->salonBean->listSalonsBySalonNombreEndsWith($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Salon que contenga $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getSalonsBySalonNombreContains($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreContains($salonNombre);
            }

            return SalonDTO::loadFromEntities($this->salonBean->getSalonsBySalonNombreContains($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Salon que contenga $salonNombre
         * 
         * @param $salonNombre
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listSalonsBySalonNombreContains($salonNombre, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if( !(EntityValidator::validateString($salonNombre))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->salonBean->countGetSalonsBySalonNombreContains($salonNombre);
            }

            return SalonDTO::loadFromEntities($this->salonBean->listSalonsBySalonNombreContains($salonNombre, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }


        /**
         * Eliminar un Salon Dado el $salonId
         * 
         * @param $salonId
        */
        public function removeSalon($salonId){
            $objetoEnInventarioBean = new ObjetoEnInventarioBean($this->persistenceManager);
            $objetoPerdidoBean = new ObjetoPerdidoBean($this->persistenceManager);
            $monitorSalonBean = new MonitorSalonBean($this->persistenceManager);
            $reservaBean = new ReservaBean($this->persistenceManager);

            $salon = new Salon();
            $salon->setId($salonId); 

            # Validamos los campos
            if( !EntityValidator::validateId($salonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            # Verificamos que la entidad exista.
            if(!$this->salonBean->getSalon($salon)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 55);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Verificamos que la entidad no esté siendo utilziada en ObjetoEnInventario->inventarioSalon
            $objetoEnInventarios = $objetoEnInventarioBean->getObjetoEnInventariosByInventarioSalon($salon);
            if(count($objetoEnInventarios) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 50);
            }

            # Verificamos que la entidad no esté siendo utilziada en ObjetoPerdido->objetoPerdidoSalon
            $objetoPerdidos = $objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoSalon($salon);
            if(count($objetoPerdidos) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 51);
            }

            # Verificamos que la entidad no esté siendo utilziada en MonitorSalon->salon
            $monitorSalons = $monitorSalonBean->getMonitorSalonsBySalon($salon);
            if(count($monitorSalons) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 52);
            }

            # Verificamos que la entidad no esté siendo utilziada en Reserva->reservaSalon
            $reservas = $reservaBean->getReservasByReservaSalon($salon);
            if(count($reservas) > 0){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL, $this->ID + 53);
            }

            # Eliminamos la entidad
            if(!$this->salonBean->removeSalon($salon)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 56);
            }

        }

    }

?>