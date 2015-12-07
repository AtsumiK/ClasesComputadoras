<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.PERSONA_ENTITY;

    class PersonaDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "persona";
        public static $PRIMARY_KEY_DB_NAME = "persona_id";

        public static $ORDER_BY_PERSONA_DOCUMENTO_IDENTIDAD = "persona_documento_identidad";
        public static $ORDER_BY_PERSONA_NOMBRES = "persona_nombres";
        public static $ORDER_BY_PERSONA_APELLIDOS = "persona_apellidos";

        # Constantes públicas para soporte de interfaz

        public $PERSONA_DOCUMENTO_IDENTIDAD = "PERSONA_DOCUMENTO_IDENTIDAD";
        public $PERSONA_NOMBRES = "PERSONA_NOMBRES";
        public $PERSONA_APELLIDOS = "PERSONA_APELLIDOS";

        # Atributos privados estandar
        private $id;
        private $personaDocumentoIdentidad;
        private $personaNombres;
        private $personaApellidos;

        function PersonaDTO($id = null, $personaDocumentoIdentidad = null, $personaNombres = null, $personaApellidos = null){
            $this->id = $id;
            $this->personaDocumentoIdentidad = $personaDocumentoIdentidad;
            $this->personaNombres = $personaNombres;
            $this->personaApellidos = $personaApellidos;
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
            $this->personaDocumentoIdentidad = $personaDocumentoIdentidad;
        }

        public function getPersonaNombres(){
            return $this->personaNombres;
        }

        public function setPersonaNombres($personaNombres){
            $this->personaNombres = $personaNombres;
        }

        public function getPersonaApellidos(){
            return $this->personaApellidos;
        }

        public function setPersonaApellidos($personaApellidos){
            $this->personaApellidos = $personaApellidos;
        }


        # Getters y setters genéricos

        public function getAttributeValue($attrName){
            if(isset($this->$attrName)){
                return $this->$attrName;
            }
            return null;
        }

        public function setAttributeValue($attrName, $attrValue) {
            if(isset($this->$attrName)){
                $this->$attrName = $attrValue;
                return true;
            }
            return null;
        }

        public function loadFromEntity($entity){
            $this->id = $entity->getId();
            $this->personaDocumentoIdentidad = $entity->unscapeString($entity->getPersonaDocumentoIdentidad());
            $this->personaNombres = $entity->unscapeString($entity->getPersonaNombres());
            $this->personaApellidos = $entity->unscapeString($entity->getPersonaApellidos());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new PersonaDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(PersonaDTO $personaDTO){
            $persona = new Persona();
            $persona->setId($personaDTO->getId());
            $persona->setPersonaDocumentoIdentidad($personaDTO->getPersonaDocumentoIdentidad());
            $persona->setPersonaNombres($personaDTO->getPersonaNombres());
            $persona->setPersonaApellidos($personaDTO->getPersonaApellidos());
            return $persona;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->personaDocumentoIdentidad) && EntityValidator::validateString($this->personaNombres) && EntityValidator::validateString($this->personaApellidos);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Persona>";
                $xml .= "<Persona_Id>";
                    $xml .= $this->getId();
                $xml .= "</Persona_Id>";
                if($this->getPersonaDocumentoIdentidad() !== null){
                    $xml .= "<personaDocumentoIdentidad><![CDATA[";
                        $xml .= $this->getPersonaDocumentoIdentidad();
                    $xml .= "]]></personaDocumentoIdentidad>";
                }
                if($this->getPersonaNombres() !== null){
                    $xml .= "<personaNombres><![CDATA[";
                        $xml .= $this->getPersonaNombres();
                    $xml .= "]]></personaNombres>";
                }
                if($this->getPersonaApellidos() !== null){
                    $xml .= "<personaApellidos><![CDATA[";
                        $xml .= $this->getPersonaApellidos();
                    $xml .= "]]></personaApellidos>";
                }
            $xml .= "</Persona>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Persona");
            foreach ($nodes as $node) {
                $dao = new PersonaDTO();
                $data = $node->getElementsByTagName("Persona_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("personaDocumentoIdentidad");
                if($data->length>0 && !PersonaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPersonaDocumentoIdentidad($data);
                $data = $node->getElementsByTagName("personaNombres");
                if($data->length>0 && !PersonaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPersonaNombres($data);
                $data = $node->getElementsByTagName("personaApellidos");
                if($data->length>0 && !PersonaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPersonaApellidos($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Personas>";
                $xml .= $this->toXML();
            $xml .= "</Personas>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Personas>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Personas>";
            return $xml;
        }
        /**
         * Esta función retorna true si la cadena es vacía
         * @param $str
        */
        public static function isEmpty($str){
            return $str == "";
        }
        /**
         * Esta función es un alias de toXML
        */
        public function __toString(){
            return $this->toXML();
        }
    }
?>
