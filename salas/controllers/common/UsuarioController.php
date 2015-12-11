<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.USUARIO_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.USUARIO_BEAN;

    

    class UsuarioController {

        private $ID = 0;

        private $persistenceManager;
        private $lastRequestSize;

        private $usuarioBean;

        function UsuarioController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->usuarioBean = new UsuarioBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Usuario al sistema.
         * 
         * @param UsuarioDTO $usuarioDTO
        */
        public function setUsuario(UsuarioDTO &$usuarioDTO){
            $usuario = UsuarioDTO::toEntity($usuarioDTO);

            # Validamos los campos
            if(!$usuario->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->usuarioBean->setUsuario($usuario)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $usuarioDTO->loadFromEntity($usuario);
        }
        /**
         * Actualizar Usuario al sistema.
         * 
         * @param UsuarioDTO $usuarioDTO
        */
        public function updateUsuario(UsuarioDTO &$usuarioDTO){
            $usuario = UsuarioDTO::toEntity($usuarioDTO);

            # Validamos los campos
            if(!$usuario->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->usuarioBean->updateUsuario($usuario)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $usuarioDTO->loadFromEntity($usuario);
        }
        /**
         * Obtener un Usuario único.
         * 
         * @param UsuarioDTO &$usuarioDTO
        */

        public function getUsuario(UsuarioDTO &$usuarioDTO){

            $usuario = UsuarioDTO::toEntity($usuarioDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($usuario->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->usuarioBean->getUsuario($usuario)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $usuarioDTO->loadFromEntity($usuario);
        }
        /**
         * Obtener todos los Usuario
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getUsuarios($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countAllUsuarios();
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getAllUsuarios($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Usuario
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listUsuarios($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countAllUsuarios();
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listAllUsuarios($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Usuario dado $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioLogin($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLogin($usuarioLogin );
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioLogin($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioLogin($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 9);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLogin($usuarioLogin);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioLogin($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioLoginBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginBetween($firstValue, $secondValue);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioLoginBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginBetween($firstValue, $secondValue);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioLoginBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginBiggerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioLoginBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioLoginBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginBiggerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioLoginBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioLoginLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginLowerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioLoginLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioLoginLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginLowerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioLoginLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Usuario comenzando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioLoginBeginsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginBeginsWith($usuarioLogin);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Usuario comenzando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioLoginBeginsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginBeginsWith($usuarioLogin);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario terminando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioLoginEndsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginEndsWith($usuarioLogin);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario terminando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioLoginEndsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginEndsWith($usuarioLogin);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario que contenga $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioLoginContains($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginContains($usuarioLogin);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioLoginContains($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario que contenga $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioLoginContains($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            if( !(EntityValidator::validateString($usuarioLogin))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioLoginContains($usuarioLogin);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioLoginContains($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioClave($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClave($usuarioClave );
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioClave($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioClave($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClave($usuarioClave);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioClave($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioClaveBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveBetween($firstValue, $secondValue);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioClaveBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveBetween($firstValue, $secondValue);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioClaveBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveBiggerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioClaveBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioClaveBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveBiggerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioClaveBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioClaveLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveLowerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioClaveLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioClaveLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveLowerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioClaveLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Usuario comenzando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioClaveBeginsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveBeginsWith($usuarioClave);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Usuario comenzando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioClaveBeginsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveBeginsWith($usuarioClave);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario terminando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioClaveEndsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveEndsWith($usuarioClave);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario terminando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioClaveEndsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveEndsWith($usuarioClave);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario que contenga $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioClaveContains($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveContains($usuarioClave);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioClaveContains($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario que contenga $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioClaveContains($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            if( !(EntityValidator::validateString($usuarioClave))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioClaveContains($usuarioClave);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioClaveContains($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioTipo($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipo($usuarioTipo );
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioTipo($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioTipo($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipo($usuarioTipo);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioTipo($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioTipoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoBetween($firstValue, $secondValue);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioTipoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoBetween($firstValue, $secondValue);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioTipoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoBiggerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioTipoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioTipoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoBiggerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioTipoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioTipoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoLowerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioTipoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioTipoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoLowerThan($value);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioTipoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Usuario comenzando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioTipoBeginsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 116);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 120);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoBeginsWith($usuarioTipo);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Usuario comenzando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioTipoBeginsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 117);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 119);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 121);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoBeginsWith($usuarioTipo);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario terminando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioTipoEndsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 122);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 124);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 126);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoEndsWith($usuarioTipo);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario terminando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioTipoEndsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 123);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 125);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 127);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoEndsWith($usuarioTipo);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuario que contenga $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosByUsuarioTipoContains($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 128);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 130);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 132);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoContains($usuarioTipo);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->getUsuariosByUsuarioTipoContains($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuario que contenga $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosByUsuarioTipoContains($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 129);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 131);
            }

            if( !(EntityValidator::validateString($usuarioTipo))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 133);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->usuarioBean->countGetUsuariosByUsuarioTipoContains($usuarioTipo);
            }

            return UsuarioDTO::loadFromEntities($this->usuarioBean->listUsuariosByUsuarioTipoContains($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }


        /**
         * Eliminar un Usuario Dado el $usuarioId
         * 
         * @param $usuarioId
        */
        public function removeUsuario($usuarioId){

            $usuario = new Usuario();
            $usuario->setId($usuarioId); 

            # Validamos los campos
            if( !EntityValidator::validateId($usuarioId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            # Verificamos que la entidad exista.
            if(!$this->usuarioBean->getUsuario($usuario)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 135);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->usuarioBean->removeUsuario($usuario)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 136);
            }

        }

    }

?>