<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.USUARIO_DTO;

    class Usuario {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "usuario";
        public $PRIMARY_KEY_DB_NAME = "usuario_id";

        public $USUARIO_LOGIN = "usuario_login";
        public static $ORDER_BY_USUARIO_LOGIN = "usuario_login";
        public $USUARIO_CLAVE = "usuario_clave";
        public static $ORDER_BY_USUARIO_CLAVE = "usuario_clave";
        public $USUARIO_TIPO = "usuario_tipo";
        public static $ORDER_BY_USUARIO_TIPO = "usuario_tipo";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $USUARIO_LOGIN_SIZE = 20;
        private $USUARIO_CLAVE_SIZE = 20;
        private $USUARIO_TIPO_SIZE = 3;

        # Atributos privados estandar
        private $id;
        private $usuarioLogin;
        private $usuarioClave;
        private $usuarioTipo;

        function Usuario($usuarioLogin = null, $usuarioClave = null, $usuarioTipo = null){
            $this->id = null;
            $this->usuarioLogin = $this->scapeString($usuarioLogin);
            $this->usuarioClave = $this->scapeString($usuarioClave);
            $this->usuarioTipo = $this->scapeString($usuarioTipo);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getUsuarioLogin(){
            return $this->usuarioLogin;
        }

        public function setUsuarioLogin($usuarioLogin){
            if(strlen($usuarioLogin) > $this->USUARIO_LOGIN_SIZE){;
                $this->usuarioLogin = $this->scapeString(substr($usuarioLogin, 0, $this->USUARIO_LOGIN_SIZE));
            }else{
                $this->usuarioLogin = $this->scapeString($usuarioLogin);
            }
        }

        public function getUsuarioClave(){
            return $this->usuarioClave;
        }

        public function setUsuarioClave($usuarioClave){
            if(strlen($usuarioClave) > $this->USUARIO_CLAVE_SIZE){;
                $this->usuarioClave = $this->scapeString(substr($usuarioClave, 0, $this->USUARIO_CLAVE_SIZE));
            }else{
                $this->usuarioClave = $this->scapeString($usuarioClave);
            }
        }

        public function getUsuarioTipo(){
            return $this->usuarioTipo;
        }

        public function setUsuarioTipo($usuarioTipo){
            if(strlen($usuarioTipo) > $this->USUARIO_TIPO_SIZE){;
                $this->usuarioTipo = $this->scapeString(substr($usuarioTipo, 0, $this->USUARIO_TIPO_SIZE));
            }else{
                $this->usuarioTipo = $this->scapeString($usuarioTipo);
            }
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->USUARIO_LOGIN,$this->ENTITY_DB_NAME.".".$this->USUARIO_CLAVE,$this->ENTITY_DB_NAME.".".$this->USUARIO_TIPO);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->USUARIO_LOGIN,$this->ENTITY_DB_NAME.".".$this->USUARIO_CLAVE,$this->ENTITY_DB_NAME.".".$this->USUARIO_TIPO);
        }

        public function getDbFieldNames(){
            return array($this->USUARIO_LOGIN,$this->USUARIO_CLAVE,$this->USUARIO_TIPO);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->USUARIO_LOGIN,$this->USUARIO_CLAVE,$this->USUARIO_TIPO);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->USUARIO_LOGIN,$this->ENTITY_DB_NAME.".".$this->USUARIO_CLAVE,$this->ENTITY_DB_NAME.".".$this->USUARIO_TIPO);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->USUARIO_LOGIN,$this->ENTITY_DB_NAME.".".$this->USUARIO_CLAVE,$this->ENTITY_DB_NAME.".".$this->USUARIO_TIPO);
        }

        public function getDbListFieldNames(){
            return array($this->USUARIO_LOGIN,$this->USUARIO_CLAVE,$this->USUARIO_TIPO);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->USUARIO_LOGIN,$this->USUARIO_CLAVE,$this->USUARIO_TIPO);
        }

        public function getDbFieldValues(){
            return array($this->getUsuarioLogin(),$this->getUsuarioClave(),$this->getUsuarioTipo());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getUsuarioLogin(),$this->getUsuarioClave(),$this->getUsuarioTipo());
        }

        public function getDbListFieldValues(){
            return array($this->getUsuarioLogin(),$this->getUsuarioClave(),$this->getUsuarioTipo());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getUsuarioLogin(),$this->getUsuarioClave(),$this->getUsuarioTipo());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->USUARIO_LOGIN]) && !UsuarioDTO::isEmpty($rq[$this->USUARIO_LOGIN])){
                $this->usuarioLogin = $this->scapeString($rq[$this->USUARIO_LOGIN]);
            }else{
                $this->usuarioLogin = null;
            }
            if(isset($rq[$this->USUARIO_CLAVE]) && !UsuarioDTO::isEmpty($rq[$this->USUARIO_CLAVE])){
                $this->usuarioClave = $this->scapeString($rq[$this->USUARIO_CLAVE]);
            }else{
                $this->usuarioClave = null;
            }
            if(isset($rq[$this->USUARIO_TIPO]) && !UsuarioDTO::isEmpty($rq[$this->USUARIO_TIPO])){
                $this->usuarioTipo = $this->scapeString($rq[$this->USUARIO_TIPO]);
            }else{
                $this->usuarioTipo = null;
            }
        }

        public function toDTO(){
            $usuarioDTO = new UsuarioDTO();
            $usuarioDTO->setId($this->getId());
            $usuarioDTO->setUsuarioLogin($this->unscapeString($this->getUsuarioLogin()));
            $usuarioDTO->setUsuarioClave($this->unscapeString($this->getUsuarioClave()));
            $usuarioDTO->setUsuarioTipo($this->unscapeString($this->getUsuarioTipo()));
            return $usuarioDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->usuarioLogin) && EntityValidator::validateString($this->usuarioClave) && EntityValidator::validateString($this->usuarioTipo);
        }
        /**
         * Esta función trata de prevenir el SQL Injection
         * @param $str
        */
        private function scapeString($str){
            if(!empty($str)){
                return addslashes(stripslashes($str));
            }else{
                return $str;
            }
        }
        public function unscapeString($str){
            if(!empty($str)){
                return stripslashes($str);
            }else{
                return $str;
            }
        }
    }
?>