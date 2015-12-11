<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.RESPONSABLE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.RESPONSABLE_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SALON_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.RESERVA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.RESERVA_BEAN;

    

    class ReservaController {

        private $ID = 12000;

        private $persistenceManager;
        private $lastRequestSize;

        private $reservaBean;

        function ReservaController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->reservaBean = new ReservaBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Reserva al sistema.
         * 
         * @param ReservaDTO $reservaDTO
        */
        public function setReserva(ReservaDTO &$reservaDTO){
            $reserva = ReservaDTO::toEntity($reservaDTO);
            $responsableBean = new ResponsableBean($this->persistenceManager);
            $responsable = new Responsable();
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();

            # Validamos los campos
            if(!$reserva->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($reserva->getReservaResponsable() !== null){
                $responsable->setId($reserva->getReservaResponsable());
                if(!$responsableBean->getResponsable($responsable)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            if($reserva->getReservaSalon() !== null){
                $salon->setId($reserva->getReservaSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 1);
                }
            }

            # Almacenamos la entidad
            if(!$this->reservaBean->setReserva($reserva)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 3);
            }

            $reservaDTO->loadFromEntity($reserva);
        }
        /**
         * Actualizar Reserva al sistema.
         * 
         * @param ReservaDTO $reservaDTO
        */
        public function updateReserva(ReservaDTO &$reservaDTO){
            $reserva = ReservaDTO::toEntity($reservaDTO);
            $responsableBean = new ResponsableBean($this->persistenceManager);
            $responsable = new Responsable();
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();

            # Validamos los campos
            if(!$reserva->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($reserva->getReservaResponsable() !== null){
                $responsable->setId($reserva->getReservaResponsable());
                if(!$responsableBean->getResponsable($responsable)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 4);
                }
            }

            if($reserva->getReservaSalon() !== null){
                $salon->setId($reserva->getReservaSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 5);
                }
            }

            # Actualizamos la entidad
            if(!$this->reservaBean->updateReserva($reserva)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 7);
            }

            $reservaDTO->loadFromEntity($reserva);
        }
        /**
         * Obtener un Reserva único.
         * 
         * @param ReservaDTO &$reservaDTO
        */

        public function getReserva(ReservaDTO &$reservaDTO){

            $reserva = ReservaDTO::toEntity($reservaDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($reserva->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            # Obtenemos la entidad
            if(!$this->reservaBean->getReserva($reserva)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 9);
            }

            $reservaDTO->loadFromEntity($reserva);
        }
        /**
         * Obtener todos los Reserva
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getReservas($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countAllReservas();
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getAllReservas($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Reserva
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listReservas($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countAllReservas();
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listAllReservas($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Reserva dado $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaClase($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClase($reservaClase );
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaClase($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaClase($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClase($reservaClase);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaClase($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaClaseBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseBetween($firstValue, $secondValue);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaClaseBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaClaseBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseBetween($firstValue, $secondValue);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaClaseBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaClaseBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseBiggerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaClaseBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaClaseBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseBiggerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaClaseBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaClaseLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseLowerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaClaseLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaClaseLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseLowerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaClaseLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Reserva comenzando por $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaClaseBeginsWith($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseBeginsWith($reservaClase);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaClaseBeginsWith($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Reserva comenzando por $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaClaseBeginsWith($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseBeginsWith($reservaClase);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaClaseBeginsWith($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva terminando por $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaClaseEndsWith($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseEndsWith($reservaClase);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaClaseEndsWith($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva terminando por $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaClaseEndsWith($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseEndsWith($reservaClase);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaClaseEndsWith($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva que contenga $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaClaseContains($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseContains($reservaClase);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaClaseContains($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva que contenga $reservaClase
         * 
         * @param $reservaClase
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaClaseContains($reservaClase, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if( !(EntityValidator::validateString($reservaClase))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaClaseContains($reservaClase);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaClaseContains($reservaClase, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado $reservaHoraInicio
         * 
         * @param $reservaHoraInicio
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraInicio($reservaHoraInicio, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if( !(EntityValidator::validateDate($reservaHoraInicio))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicio($reservaHoraInicio );
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraInicio($reservaHoraInicio, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado $reservaHoraInicio
         * 
         * @param $reservaHoraInicio
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraInicio($reservaHoraInicio, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if( !(EntityValidator::validateDate($reservaHoraInicio))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicio($reservaHoraInicio);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraInicio($reservaHoraInicio, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraInicioBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicioBetween($firstValue, $secondValue);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraInicioBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraInicioBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicioBetween($firstValue, $secondValue);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraInicioBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraInicioBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicioBiggerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraInicioBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraInicioBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicioBiggerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraInicioBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraInicioLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicioLowerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraInicioLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraInicioLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraInicioLowerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraInicioLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado $reservaHoraFin
         * 
         * @param $reservaHoraFin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraFin($reservaHoraFin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if( !(EntityValidator::validateDate($reservaHoraFin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFin($reservaHoraFin );
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraFin($reservaHoraFin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado $reservaHoraFin
         * 
         * @param $reservaHoraFin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraFin($reservaHoraFin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if( !(EntityValidator::validateDate($reservaHoraFin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFin($reservaHoraFin);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraFin($reservaHoraFin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraFinBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFinBetween($firstValue, $secondValue);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraFinBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraFinBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFinBetween($firstValue, $secondValue);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraFinBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraFinBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFinBiggerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraFinBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraFinBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFinBiggerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraFinBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaHoraFinLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFinLowerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaHoraFinLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaHoraFinLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaHoraFinLowerThan($value);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaHoraFinLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Reserva dado el $reservaResponsableId
         * 
         * @param $reservaResponsableId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaResponsableId($reservaResponsableId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ResponsableBean($this->persistenceManager);
            $obj = new Responsable();
            $obj->setId($reservaResponsableId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if( !EntityValidator::validateId($reservaResponsableId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getResponsable($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 108);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaResponsable($obj);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaResponsable($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado el $reservaResponsableId
         * 
         * @param $reservaResponsableId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaResponsableId($reservaResponsableId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ResponsableBean($this->persistenceManager);
            $obj = new Responsable();
            $obj->setId($reservaResponsableId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if( !EntityValidator::validateId($reservaResponsableId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getResponsable($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 109);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaResponsable($obj);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaResponsable($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }
        /**
         * Obtener algunos Reserva dado el $reservaSalonId
         * 
         * @param $reservaSalonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getReservasByReservaSalonId($reservaSalonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($reservaSalonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if( !EntityValidator::validateId($reservaSalonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 116);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaSalon($obj);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->getReservasByReservaSalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Reserva dado el $reservaSalonId
         * 
         * @param $reservaSalonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listReservasByReservaSalonId($reservaSalonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($reservaSalonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if( !EntityValidator::validateId($reservaSalonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 117);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->reservaBean->countGetReservasByReservaSalon($obj);
            }

            return ReservaDTO::loadFromEntities($this->reservaBean->listReservasByReservaSalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un Reserva Dado el $reservaId
         * 
         * @param $reservaId
        */
        public function removeReserva($reservaId){

            $reserva = new Reserva();
            $reserva->setId($reservaId); 

            # Validamos los campos
            if( !EntityValidator::validateId($reservaId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            # Verificamos que la entidad exista.
            if(!$this->reservaBean->getReserva($reserva)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 119);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->reservaBean->removeReserva($reserva)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 120);
            }

        }

    }

?>