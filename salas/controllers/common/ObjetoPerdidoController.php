<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SALON_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.ESTUDIANTE_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.OBJETO_PERDIDO_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.OBJETO_PERDIDO_BEAN;

    

    class ObjetoPerdidoController {

        private $ID = 5000;

        private $persistenceManager;
        private $lastRequestSize;

        private $objetoPerdidoBean;

        function ObjetoPerdidoController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->objetoPerdidoBean = new ObjetoPerdidoBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar ObjetoPerdido al sistema.
         * 
         * @param ObjetoPerdidoDTO $objetoPerdidoDTO
        */
        public function setObjetoPerdido(ObjetoPerdidoDTO &$objetoPerdidoDTO){
            $objetoPerdido = ObjetoPerdidoDTO::toEntity($objetoPerdidoDTO);
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();

            # Validamos los campos
            if(!$objetoPerdido->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($objetoPerdido->getObjetoPerdidoSalon() !== null){
                $salon->setId($objetoPerdido->getObjetoPerdidoSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            if($objetoPerdido->getObjetoPerdidoEstudiante() !== null){
                $estudiante->setId($objetoPerdido->getObjetoPerdidoEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 1);
                }
            }

            # Almacenamos la entidad
            if(!$this->objetoPerdidoBean->setObjetoPerdido($objetoPerdido)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 3);
            }

            $objetoPerdidoDTO->loadFromEntity($objetoPerdido);
        }
        /**
         * Actualizar ObjetoPerdido al sistema.
         * 
         * @param ObjetoPerdidoDTO $objetoPerdidoDTO
        */
        public function updateObjetoPerdido(ObjetoPerdidoDTO &$objetoPerdidoDTO){
            $objetoPerdido = ObjetoPerdidoDTO::toEntity($objetoPerdidoDTO);
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();

            # Validamos los campos
            if(!$objetoPerdido->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($objetoPerdido->getObjetoPerdidoSalon() !== null){
                $salon->setId($objetoPerdido->getObjetoPerdidoSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 4);
                }
            }

            if($objetoPerdido->getObjetoPerdidoEstudiante() !== null){
                $estudiante->setId($objetoPerdido->getObjetoPerdidoEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 5);
                }
            }

            # Actualizamos la entidad
            if(!$this->objetoPerdidoBean->updateObjetoPerdido($objetoPerdido)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 7);
            }

            $objetoPerdidoDTO->loadFromEntity($objetoPerdido);
        }
        /**
         * Obtener un ObjetoPerdido único.
         * 
         * @param ObjetoPerdidoDTO &$objetoPerdidoDTO
        */

        public function getObjetoPerdido(ObjetoPerdidoDTO &$objetoPerdidoDTO){

            $objetoPerdido = ObjetoPerdidoDTO::toEntity($objetoPerdidoDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($objetoPerdido->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            # Obtenemos la entidad
            if(!$this->objetoPerdidoBean->getObjetoPerdido($objetoPerdido)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 9);
            }

            $objetoPerdidoDTO->loadFromEntity($objetoPerdido);
        }
        /**
         * Obtener todos los ObjetoPerdido
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getObjetoPerdidos($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countAllObjetoPerdidos();
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getAllObjetoPerdidos($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los ObjetoPerdido
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listObjetoPerdidos($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countAllObjetoPerdidos();
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listAllObjetoPerdidos($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos ObjetoPerdido dado $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento );
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoElementoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoElementoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoElementoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoElementoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos ObjetoPerdido comenzando por $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos ObjetoPerdido comenzando por $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido terminando por $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido terminando por $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido que contenga $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido que contenga $objetoPerdidoElemento
         * 
         * @param $objetoPerdidoElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if( !(EntityValidator::validateString($objetoPerdidoElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado $objetoPerdidoFecha
         * 
         * @param $objetoPerdidoFecha
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if( !(EntityValidator::validateDate($objetoPerdidoFecha))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha );
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado $objetoPerdidoFecha
         * 
         * @param $objetoPerdidoFecha
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if( !(EntityValidator::validateDate($objetoPerdidoFecha))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFechaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFechaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFechaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFechaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo );
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos ObjetoPerdido comenzando por $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos ObjetoPerdido comenzando por $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido terminando por $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido terminando por $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido que contenga $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido que contenga $objetoPerdidoCorreo
         * 
         * @param $objetoPerdidoCorreo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            if( !(EntityValidator::validateString($objetoPerdidoCorreo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado $objetoPerdidoFechaDevolucion
         * 
         * @param $objetoPerdidoFechaDevolucion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            if( !(EntityValidator::validateDate($objetoPerdidoFechaDevolucion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion );
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado $objetoPerdidoFechaDevolucion
         * 
         * @param $objetoPerdidoFechaDevolucion
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            if( !(EntityValidator::validateDate($objetoPerdidoFechaDevolucion))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 136);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 135);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 137);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 138);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 140);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 142);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 139);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 141);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 143);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 144);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 146);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 148);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios );
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 145);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 147);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 149);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 150);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 152);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 154);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 151);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 153);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 155);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 156);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 158);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 160);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 157);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 159);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 161);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 162);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 164);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 166);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 163);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 165);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 167);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos ObjetoPerdido comenzando por $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 168);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 170);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 172);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos ObjetoPerdido comenzando por $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 169);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 171);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 173);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido terminando por $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 174);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 176);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 178);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido terminando por $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 175);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 177);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 179);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido que contenga $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 180);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 182);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 184);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido que contenga $objetoPerdidoComentarios
         * 
         * @param $objetoPerdidoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 181);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 183);
            }

            if( !(EntityValidator::validateString($objetoPerdidoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 185);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoPerdido dado el $objetoPerdidoSalonId
         * 
         * @param $objetoPerdidoSalonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoSalonId($objetoPerdidoSalonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($objetoPerdidoSalonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 186);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 188);
            }

            if( !EntityValidator::validateId($objetoPerdidoSalonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 190);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 192);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoSalon($obj);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoSalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado el $objetoPerdidoSalonId
         * 
         * @param $objetoPerdidoSalonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoSalonId($objetoPerdidoSalonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($objetoPerdidoSalonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 187);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 189);
            }

            if( !EntityValidator::validateId($objetoPerdidoSalonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 191);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 193);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoSalon($obj);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoSalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }
        /**
         * Obtener algunos ObjetoPerdido dado el $objetoPerdidoEstudianteId
         * 
         * @param $objetoPerdidoEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoPerdidosByObjetoPerdidoEstudianteId($objetoPerdidoEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($objetoPerdidoEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 194);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 196);
            }

            if( !EntityValidator::validateId($objetoPerdidoEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 198);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 200);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoEstudiante($obj);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->getObjetoPerdidosByObjetoPerdidoEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoPerdido dado el $objetoPerdidoEstudianteId
         * 
         * @param $objetoPerdidoEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoPerdidosByObjetoPerdidoEstudianteId($objetoPerdidoEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($objetoPerdidoEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 195);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 197);
            }

            if( !EntityValidator::validateId($objetoPerdidoEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 199);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 201);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoPerdidoBean->countGetObjetoPerdidosByObjetoPerdidoEstudiante($obj);
            }

            return ObjetoPerdidoDTO::loadFromEntities($this->objetoPerdidoBean->listObjetoPerdidosByObjetoPerdidoEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un ObjetoPerdido Dado el $objetoPerdidoId
         * 
         * @param $objetoPerdidoId
        */
        public function removeObjetoPerdido($objetoPerdidoId){

            $objetoPerdido = new ObjetoPerdido();
            $objetoPerdido->setId($objetoPerdidoId); 

            # Validamos los campos
            if( !EntityValidator::validateId($objetoPerdidoId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 202);
            }

            # Verificamos que la entidad exista.
            if(!$this->objetoPerdidoBean->getObjetoPerdido($objetoPerdido)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 203);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->objetoPerdidoBean->removeObjetoPerdido($objetoPerdido)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 204);
            }

        }

    }

?>