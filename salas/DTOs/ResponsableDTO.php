<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.RESPONSABLE_ENTITY;

    class ResponsableDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "responsable";
        public static $PRIMARY_KEY_DB_NAME = "responsable_id";

        public static $ORDER_BY_RESPONSABLE_FACULTAD = "responsable_facultad";
        public static $ORDER_BY_RESPONSABLE_ASIGNATURA = "responsable_asignatura";
        public static $ORDER_BY_RESPONSABLE_PERSONA = "responsable_persona";

        # Constantes públicas para soporte de interfaz

        public $RESPONSABLE_FACULTAD = "RESPONSABLE_FACULTAD";
        public $RESPONSABLE_ASIGNATURA = "RESPONSABLE_ASIGNATURA";
        public $RESPONSABLE_PERSONA = "RESPONSABLE_PERSONA";

        # Atributos privados estandar
        private $id;
        private $responsableFacultad;
        private $responsableAsignatura;
        private $responsablePersona;

        function ResponsableDTO($id = null, $responsableFacultad = null, $responsableAsignatura = null, $responsablePersona = null){
            $this->id = $id;
            $this->responsableFacultad = $responsableFacultad;
            $this->responsableAsignatura = $responsableAsignatura;
            $this->responsablePersona = $responsablePersona;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getResponsableFacultad(){
            return $this->responsableFacultad;
        }

        public function setResponsableFacultad($responsableFacultad){
            $this->responsableFacultad = $responsableFacultad;
        }

        public function getResponsableAsignatura(){
            return $this->responsableAsignatura;
        }

        public function setResponsableAsignatura($responsableAsignatura){
            $this->responsableAsignatura = $responsableAsignatura;
        }

        public function getResponsablePersona(){
            return $this->responsablePersona;
        }

        public function setResponsablePersona($responsablePersona){
            $this->responsablePersona = $responsablePersona;
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
            $this->responsableFacultad = $entity->unscapeString($entity->getResponsableFacultad());
            $this->responsableAsignatura = $entity->unscapeString($entity->getResponsableAsignatura());
            $this->responsablePersona = $entity->unscapeString($entity->getResponsablePersona());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new ResponsableDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(ResponsableDTO $responsableDTO){
            $responsable = new Responsable();
            $responsable->setId($responsableDTO->getId());
            $responsable->setResponsableFacultad($responsableDTO->getResponsableFacultad());
            $responsable->setResponsableAsignatura($responsableDTO->getResponsableAsignatura());
            $responsable->setResponsablePersona($responsableDTO->getResponsablePersona());
            return $responsable;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->responsableFacultad) && EntityValidator::validateString($this->responsableAsignatura) && EntityValidator::validateId($this->responsablePersona);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Responsable>";
                $xml .= "<Responsable_Id>";
                    $xml .= $this->getId();
                $xml .= "</Responsable_Id>";
                if($this->getResponsableFacultad() !== null){
                    $xml .= "<responsableFacultad><![CDATA[";
                        $xml .= $this->getResponsableFacultad();
                    $xml .= "]]></responsableFacultad>";
                }
                if($this->getResponsableAsignatura() !== null){
                    $xml .= "<responsableAsignatura><![CDATA[";
                        $xml .= $this->getResponsableAsignatura();
                    $xml .= "]]></responsableAsignatura>";
                }
                if($this->responsablePersona !== null){
                    $xml .= "<responsablePersona>";
                        $xml .= "<responsablePersona_id>";
                            $xml .= $this->responsablePersona;
                        $xml .= "</responsablePersona_id>";
                    $xml .= "</responsablePersona>";
                }
            $xml .= "</Responsable>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Responsable");
            foreach ($nodes as $node) {
                $dao = new ResponsableDTO();
                $data = $node->getElementsByTagName("Responsable_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("responsableFacultad");
                if($data->length>0 && !ResponsableDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setResponsableFacultad($data);
                $data = $node->getElementsByTagName("responsableAsignatura");
                if($data->length>0 && !ResponsableDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setResponsableAsignatura($data);
                $data = $node->getElementsByTagName("responsablePersona");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setResponsablePersona($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Responsables>";
                $xml .= $this->toXML();
            $xml .= "</Responsables>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Responsables>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Responsables>";
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