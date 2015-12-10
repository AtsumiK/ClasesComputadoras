<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.USUARIOS_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.USUARIOS_BEAN;

    

    class UsuariosController {

        private $ID = 0;

        private $persistenceManager;
        private $lastRequestSize;

        private $usuariosBean;

        function UsuariosController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->usuariosBean = new UsuariosBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Usuarios al sistema.
         * 
         * @param UsuariosDTO $usuariosDTO
        */
        public function setUsuarios(UsuariosDTO &$usuariosDTO){
            $usuarios = UsuariosDTO::toEntity($usuariosDTO);

            # Validamos los campos
            if(!$usuarios->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 0);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Almacenamos la entidad
            if(!$this->usuariosBean->setUsuarios($usuarios)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 1);
            }

            $usuariosDTO->loadFromEntity($usuarios);
        }
        /**
         * Actualizar Usuarios al sistema.
         * 
         * @param UsuariosDTO $usuariosDTO
        */
        public function updateUsuarios(UsuariosDTO &$usuariosDTO){
            $usuarios = UsuariosDTO::toEntity($usuariosDTO);

            # Validamos los campos
            if(!$usuarios->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            # Actualizamos la entidad
            if(!$this->usuariosBean->updateUsuarios($usuarios)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 3);
            }

            $usuariosDTO->loadFromEntity($usuarios);
        }
        /**
         * Obtener un Usuarios único.
         * 
         * @param UsuariosDTO &$usuariosDTO
        */

        public function getUsuarios(UsuariosDTO &$usuariosDTO){

            $usuarios = UsuariosDTO::toEntity($usuariosDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($usuarios->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 4);
            }

            # Obtenemos la entidad
            if(!$this->usuariosBean->getUsuarios($usuarios)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 5);
            }

            $usuariosDTO->loadFromEntity($usuarios);
        }
        /**
         * Obtener todos los Usuarios
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getUsuarioses($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->usuariosBean->countAllUsuarioses();
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getAllUsuarioses($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Usuarios
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listUsuarioses($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 7);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->usuariosBean->countAllUsuarioses();
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listAllUsuarioses($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Usuarios dado $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioLogin($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLogin($usuarioLogin );
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioLogin($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioLogin($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLogin($usuarioLogin);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioLogin($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioLoginBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginBetween($firstValue, $secondValue);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioLoginBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginBetween($firstValue, $secondValue);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioLoginBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginBiggerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioLoginBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioLoginBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginBiggerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioLoginBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioLoginLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginLowerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioLoginLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioLoginLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginLowerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioLoginLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Usuarios comenzando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioLoginBeginsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginBeginsWith($usuarioLogin);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Usuarios comenzando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioLoginBeginsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginBeginsWith($usuarioLogin);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios terminando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioLoginEndsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginEndsWith($usuarioLogin);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios terminando por $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioLoginEndsWith($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginEndsWith($usuarioLogin);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios que contenga $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioLoginContains($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginContains($usuarioLogin);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioLoginContains($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios que contenga $usuarioLogin
         * 
         * @param $usuarioLogin
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioLoginContains($usuarioLogin, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioLoginContains($usuarioLogin);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioLoginContains($usuarioLogin, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioClave($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClave($usuarioClave );
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioClave($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioClave($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClave($usuarioClave);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioClave($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioClaveBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveBetween($firstValue, $secondValue);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioClaveBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveBetween($firstValue, $secondValue);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioClaveBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveBiggerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioClaveBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioClaveBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveBiggerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioClaveBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioClaveLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveLowerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioClaveLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioClaveLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveLowerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioClaveLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Usuarios comenzando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioClaveBeginsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveBeginsWith($usuarioClave);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Usuarios comenzando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioClaveBeginsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveBeginsWith($usuarioClave);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios terminando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioClaveEndsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveEndsWith($usuarioClave);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios terminando por $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioClaveEndsWith($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveEndsWith($usuarioClave);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios que contenga $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioClaveContains($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveContains($usuarioClave);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioClaveContains($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios que contenga $usuarioClave
         * 
         * @param $usuarioClave
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioClaveContains($usuarioClave, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioClaveContains($usuarioClave);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioClaveContains($usuarioClave, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioTipo($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipo($usuarioTipo );
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioTipo($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioTipo($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipo($usuarioTipo);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioTipo($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioTipoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoBetween($firstValue, $secondValue);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioTipoBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoBetween($firstValue, $secondValue);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioTipoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoBiggerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioTipoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioTipoBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoBiggerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioTipoBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioTipoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoLowerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioTipoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioTipoLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoLowerThan($value);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioTipoLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Usuarios comenzando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioTipoBeginsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoBeginsWith($usuarioTipo);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Usuarios comenzando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioTipoBeginsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoBeginsWith($usuarioTipo);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios terminando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioTipoEndsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoEndsWith($usuarioTipo);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios terminando por $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioTipoEndsWith($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoEndsWith($usuarioTipo);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Usuarios que contenga $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getUsuariosesByUsuarioTipoContains($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoContains($usuarioTipo);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->getUsuariosesByUsuarioTipoContains($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Usuarios que contenga $usuarioTipo
         * 
         * @param $usuarioTipo
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listUsuariosesByUsuarioTipoContains($usuarioTipo, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
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
                $this->lastRequestSize = $this->usuariosBean->countGetUsuariosesByUsuarioTipoContains($usuarioTipo);
            }

            return UsuariosDTO::loadFromEntities($this->usuariosBean->listUsuariosesByUsuarioTipoContains($usuarioTipo, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }


        /**
         * Eliminar un Usuarios Dado el $usuariosId
         * 
         * @param $usuariosId
        */
        public function removeUsuarios($usuariosId){

            $usuarios = new Usuarios();
            $usuarios->setId($usuariosId); 

            # Validamos los campos
            if( !EntityValidator::validateId($usuariosId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 134);
            }

            # Verificamos que la entidad exista.
            if(!$this->usuariosBean->getUsuarios($usuarios)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 135);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->usuariosBean->removeUsuarios($usuarios)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 136);
            }

        }

    }

?>