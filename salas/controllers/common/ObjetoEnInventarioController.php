<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.SALON_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.COMPUTADORA_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.OBJETO_EN_INVENTARIO_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.OBJETO_EN_INVENTARIO_BEAN;



    class ObjetoEnInventarioController {

        private $ID = 2000;

        private $persistenceManager;
        private $lastRequestSize;

        private $objetoEnInventarioBean;

        function ObjetoEnInventarioController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->objetoEnInventarioBean = new ObjetoEnInventarioBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar ObjetoEnInventario al sistema.
         *
         * @param ObjetoEnInventarioDTO $objetoEnInventarioDTO
        */
        public function setObjetoEnInventario(ObjetoEnInventarioDTO &$objetoEnInventarioDTO){
            $objetoEnInventario = ObjetoEnInventarioDTO::toEntity($objetoEnInventarioDTO);
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();
            $computadoraBean = new ComputadoraBean($this->persistenceManager);
            $computadora = new Computadora();

            # Validamos los campos
            if(!$objetoEnInventario->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($objetoEnInventario->getInventarioSalon() !== null){
                $salon->setId($objetoEnInventario->getInventarioSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            if($objetoEnInventario->getComputadora() !== null){
                $computadora->setId($objetoEnInventario->getComputadora());
                if(!$computadoraBean->getComputadora($computadora)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 1);
                }
            }

            # Almacenamos la entidad
            if(!$this->objetoEnInventarioBean->setObjetoEnInventario($objetoEnInventario)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 3);
            }

            $objetoEnInventarioDTO->loadFromEntity($objetoEnInventario);
        }
        /**
         * Actualizar ObjetoEnInventario al sistema.
         *
         * @param ObjetoEnInventarioDTO $objetoEnInventarioDTO
        */
        public function updateObjetoEnInventario(ObjetoEnInventarioDTO &$objetoEnInventarioDTO){
            $objetoEnInventario = ObjetoEnInventarioDTO::toEntity($objetoEnInventarioDTO);
            $salonBean = new SalonBean($this->persistenceManager);
            $salon = new Salon();
            $computadoraBean = new ComputadoraBean($this->persistenceManager);
            $computadora = new Computadora();

            # Validamos los campos
            if(!$objetoEnInventario->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($objetoEnInventario->getInventarioSalon() !== null){
                $salon->setId($objetoEnInventario->getInventarioSalon());
                if(!$salonBean->getSalon($salon)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 4);
                }
            }

            if($objetoEnInventario->getComputadora() !== null){
                $computadora->setId($objetoEnInventario->getComputadora());
                if(!$computadoraBean->getComputadora($computadora)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 5);
                }
            }

            # Actualizamos la entidad
            if(!$this->objetoEnInventarioBean->updateObjetoEnInventario($objetoEnInventario)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 7);
            }

            $objetoEnInventarioDTO->loadFromEntity($objetoEnInventario);
        }
        /**
         * Obtener un ObjetoEnInventario único.
         *
         * @param ObjetoEnInventarioDTO &$objetoEnInventarioDTO
        */

        public function getObjetoEnInventario(ObjetoEnInventarioDTO &$objetoEnInventarioDTO){

            $objetoEnInventario = ObjetoEnInventarioDTO::toEntity($objetoEnInventarioDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($objetoEnInventario->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            # Obtenemos la entidad
            if(!$this->objetoEnInventarioBean->getObjetoEnInventario($objetoEnInventario)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 9);
            }

            $objetoEnInventarioDTO->loadFromEntity($objetoEnInventario);
        }
        /**
         * Obtener todos los ObjetoEnInventario
         *
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getObjetoEnInventarios($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countAllObjetoEnInventarios();
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getAllObjetoEnInventarios($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los ObjetoEnInventario
         *
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listObjetoEnInventarios($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countAllObjetoEnInventarios();
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listAllObjetoEnInventarios($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos ObjetoEnInventario dado $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioElemento($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElemento($inventarioElemento );
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioElemento($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioElemento($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElemento($inventarioElemento);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioElemento($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioElementoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoBiggerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioElementoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioElementoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoBiggerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioElementoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioElementoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoLowerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioElementoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioElementoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoLowerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioElementoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos ObjetoEnInventario comenzando por $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos ObjetoEnInventario comenzando por $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario terminando por $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario terminando por $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario que contenga $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioElementoContains($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoContains($inventarioElemento);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioElementoContains($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario que contenga $inventarioElemento
         *
         * @param $inventarioElemento
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioElementoContains($inventarioElemento, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if( !(EntityValidator::validateString($inventarioElemento))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioElementoContains($inventarioElemento);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioElementoContains($inventarioElemento, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie );
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado un rango
         *
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado un rango superior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioNumeroSerieLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieLowerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioNumeroSerieLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado un rango inferior
         *
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioNumeroSerieLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieLowerThan($value);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioNumeroSerieLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos ObjetoEnInventario comenzando por $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos ObjetoEnInventario comenzando por $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario terminando por $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario terminando por $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario que contenga $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario que contenga $inventarioNumeroSerie
         *
         * @param $inventarioNumeroSerie
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if( !(EntityValidator::validateString($inventarioNumeroSerie))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos ObjetoEnInventario dado el $inventarioSalonId
         *
         * @param $inventarioSalonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByInventarioSalonId($inventarioSalonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($inventarioSalonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if( !EntityValidator::validateId($inventarioSalonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 102);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioSalon($obj);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByInventarioSalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado el $inventarioSalonId
         *
         * @param $inventarioSalonId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByInventarioSalonId($inventarioSalonId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new SalonBean($this->persistenceManager);
            $obj = new Salon();
            $obj->setId($inventarioSalonId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if( !EntityValidator::validateId($inventarioSalonId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getSalon($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 103);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByInventarioSalon($obj);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByInventarioSalon($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }
        /**
         * Obtener algunos ObjetoEnInventario dado el $computadoraId
         *
         * @param $computadoraId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getObjetoEnInventariosByComputadoraId($computadoraId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ComputadoraBean($this->persistenceManager);
            $obj = new Computadora();
            $obj->setId($computadoraId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            if( !EntityValidator::validateId($computadoraId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 108);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getComputadora($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 110);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByComputadora($obj);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->getObjetoEnInventariosByComputadora($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos ObjetoEnInventario dado el $computadoraId
         *
         * @param $computadoraId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listObjetoEnInventariosByComputadoraId($computadoraId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ComputadoraBean($this->persistenceManager);
            $obj = new Computadora();
            $obj->setId($computadoraId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            if( !EntityValidator::validateId($computadoraId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 109);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getComputadora($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 111);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->objetoEnInventarioBean->countGetObjetoEnInventariosByComputadora($obj);
            }

            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->listObjetoEnInventariosByComputadora($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un ObjetoEnInventario Dado el $objetoEnInventarioId
         *
         * @param $objetoEnInventarioId
        */
        public function removeObjetoEnInventario($objetoEnInventarioId){

            $objetoEnInventario = new ObjetoEnInventario();
            $objetoEnInventario->setId($objetoEnInventarioId);

            # Validamos los campos
            if( !EntityValidator::validateId($objetoEnInventarioId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            # Verificamos que la entidad exista.
            if(!$this->objetoEnInventarioBean->getObjetoEnInventario($objetoEnInventario)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 113);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->objetoEnInventarioBean->removeObjetoEnInventario($objetoEnInventario)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 114);
            }

        }

        // Funciones personalizadas
        public function darInventarioComputador(){
            return ObjetoEnInventarioDTO::loadFromEntities($this->objetoEnInventarioBean->darInventarioComputador());
        }
    }

?>
