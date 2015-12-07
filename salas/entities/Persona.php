<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.PERSONA_DTO;

    class Persona {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "persona";
        public $PRIMARY_KEY_DB_NAME = "persona_id";

        public $PERSONA_DOCUMENTO_IDENTIDAD = "persona_documento_identidad";
        public static $ORDER_BY_PERSONA_DOCUMENTO_IDENTIDAD = "persona_documento_identidad";
        public $PERSONA_NOMBRES = "persona_nombres";
        public static $ORDER_BY_PERSONA_NOMBRES = "persona_nombres";
        public $PERSONA_APELLIDOS = "persona_apellidos";
        public static $ORDER_BY_PERSONA_APELLIDOS = "persona_apellidos";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $PERSONA_DOCUMENTO_IDENTIDAD_SIZE = 20;
        private $PERSONA_NOMBRES_SIZE = 250;
        private $PERSONA_APELLIDOS_SIZE = 250;

        # Atributos privados estandar
        private $id;
        private $personaDocumentoIdentidad;
        private $personaNombres;
        private $personaApellidos;

        function Persona($personaDocumentoIdentidad = null, $personaNombres = null, $personaApellidos = null){
            $this->id = null;
            $this->personaDocumentoIdentidad = $this->scapeString($personaDocumentoIdentidad);
            $this->personaNombres = $this->scapeString($personaNombres);
            $this->personaApellidos = $this->scapeString($personaApellidos);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getPersonaDocumentoIdentidad(){
            return $this->personaDocumentoIdentidad;
        }

        public function setPersonaDocumentoIdentidad($personaDocumentoIdentidad){
            if(strlen($personaDocumentoIdentidad) > $this->PERSONA_DOCUMENTO_IDENTIDAD_SIZE){;
                $this->personaDocumentoIdentidad = $this->scapeString(substr($personaDocumentoIdentidad, 0, $this->PERSONA_DOCUMENTO_IDENTIDAD_SIZE));
            }else{
                $this->personaDocumentoIdentidad = $this->scapeString($personaDocumentoIdentidad);
            }
        }

        public function getPersonaNombres(){
            return $this->personaNombres;
        }

        public function setPersonaNombres($personaNombres){
            if(strlen($personaNombres) > $this->PERSONA_NOMBRES_SIZE){;
                $this->personaNombres = $this->scapeString(substr($personaNombres, 0, $this->PERSONA_NOMBRES_SIZE));
            }else{
                $this->personaNombres = $this->scapeString($personaNombres);
            }
        }

        public function getPersonaApellidos(){
            return $this->personaApellidos;
        }

        public function setPersonaApellidos($personaApellidos){
            if(strlen($personaApellidos) > $this->PERSONA_APELLIDOS_SIZE){;
                $this->personaApellidos = $this->scapeString(substr($personaApellidos, 0, $this->PERSONA_APELLIDOS_SIZE));
            }else{
                $this->personaApellidos = $this->scapeString($personaApellidos);
            }
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->PERSONA_DOCUMENTO_IDENTIDAD,$this->ENTITY_DB_NAME.".".$this->PERSONA_NOMBRES,$this->ENTITY_DB_NAME.".".$this->PERSONA_APELLIDOS);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->PERSONA_DOCUMENTO_IDENTIDAD,$this->ENTITY_DB_NAME.".".$this->PERSONA_NOMBRES,$this->ENTITY_DB_NAME.".".$this->PERSONA_APELLIDOS);
        }

        public function getDbFieldNames(){
            return array($this->PERSONA_DOCUMENTO_IDENTIDAD,$this->PERSONA_NOMBRES,$this->PERSONA_APELLIDOS);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->PERSONA_DOCUMENTO_IDENTIDAD,$this->PERSONA_NOMBRES,$this->PERSONA_APELLIDOS);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->PERSONA_DOCUMENTO_IDENTIDAD,$this->ENTITY_DB_NAME.".".$this->PERSONA_NOMBRES,$this->ENTITY_DB_NAME.".".$this->PERSONA_APELLIDOS);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->PERSONA_DOCUMENTO_IDENTIDAD,$this->ENTITY_DB_NAME.".".$this->PERSONA_NOMBRES,$this->ENTITY_DB_NAME.".".$this->PERSONA_APELLIDOS);
        }

        public function getDbListFieldNames(){
            return array($this->PERSONA_DOCUMENTO_IDENTIDAD,$this->PERSONA_NOMBRES,$this->PERSONA_APELLIDOS);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->PERSONA_DOCUMENTO_IDENTIDAD,$this->PERSONA_NOMBRES,$this->PERSONA_APELLIDOS);
        }

        public function getDbFieldValues(){
            return array($this->getPersonaDocumentoIdentidad(),$this->getPersonaNombres(),$this->getPersonaApellidos());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getPersonaDocumentoIdentidad(),$this->getPersonaNombres(),$this->getPersonaApellidos());
        }

        public function getDbListFieldValues(){
            return array($this->getPersonaDocumentoIdentidad(),$this->getPersonaNombres(),$this->getPersonaApellidos());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getPersonaDocumentoIdentidad(),$this->getPersonaNombres(),$this->getPersonaApellidos());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->PERSONA_DOCUMENTO_IDENTIDAD]) && !PersonaDTO::isEmpty($rq[$this->PERSONA_DOCUMENTO_IDENTIDAD])){
                $this->personaDocumentoIdentidad = $this->scapeString($rq[$this->PERSONA_DOCUMENTO_IDENTIDAD]);
            }else{
                $this->personaDocumentoIdentidad = null;
            }
            if(isset($rq[$this->PERSONA_NOMBRES]) && !PersonaDTO::isEmpty($rq[$this->PERSONA_NOMBRES])){
                $this->personaNombres = $this->scapeString($rq[$this->PERSONA_NOMBRES]);
            }else{
                $this->personaNombres = null;
            }
            if(isset($rq[$this->PERSONA_APELLIDOS]) && !PersonaDTO::isEmpty($rq[$this->PERSONA_APELLIDOS])){
                $this->personaApellidos = $this->scapeString($rq[$this->PERSONA_APELLIDOS]);
            }else{
                $this->personaApellidos = null;
            }
        }

        public function toDTO(){
            $personaDTO = new PersonaDTO();
            $personaDTO->setId($this->getId());
            $personaDTO->setPersonaDocumentoIdentidad($this->unscapeString($this->getPersonaDocumentoIdentidad()));
            $personaDTO->setPersonaNombres($this->unscapeString($this->getPersonaNombres()));
            $personaDTO->setPersonaApellidos($this->unscapeString($this->getPersonaApellidos()));
            return $personaDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->personaDocumentoIdentidad) && EntityValidator::validateString($this->personaNombres) && EntityValidator::validateString($this->personaApellidos);
        }
        /**
         * Esta función trata de prevenir el SQL Injection
         * @param $str
        */
        private function scapeString($str){
            if(!empty($str)){
                return str_replace(array("'","’"),"''",$str);
            }else{
                return $str;
            }
        }
        public function unscapeString($str){
            if(!empty($str)){
                return str_replace(array("''"),"'",$str);
            }else{
                return $str;
            }
        }
    }
?>