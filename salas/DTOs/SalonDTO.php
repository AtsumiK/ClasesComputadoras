<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;

    class SalonDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "salon";
        public static $PRIMARY_KEY_DB_NAME = "salon_id";

        public static $ORDER_BY_SALON_NOMBRE = "salon_nombre";

        # Constantes públicas para soporte de interfaz

        public $SALON_NOMBRE = "SALON_NOMBRE";

        # Atributos privados estandar
        private $id;
        private $salonNombre;

        function SalonDTO($id = null, $salonNombre = null){
            $this->id = $id;
            $this->salonNombre = $salonNombre;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getSalonNombre(){
            return $this->salonNombre;
        }

        public function setSalonNombre($salonNombre){
            $this->salonNombre = $salonNombre;
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
            $this->salonNombre = $entity->unscapeString($entity->getSalonNombre());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new SalonDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(SalonDTO $salonDTO){
            $salon = new Salon();
            $salon->setId($salonDTO->getId());
            $salon->setSalonNombre($salonDTO->getSalonNombre());
            return $salon;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->salonNombre);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Salon>";
                $xml .= "<Salon_Id>";
                    $xml .= $this->getId();
                $xml .= "</Salon_Id>";
                if($this->getSalonNombre() !== null){
                    $xml .= "<salonNombre><![CDATA[";
                        $xml .= $this->getSalonNombre();
                    $xml .= "]]></salonNombre>";
                }
            $xml .= "</Salon>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Salon");
            foreach ($nodes as $node) {
                $dao = new SalonDTO();
                $data = $node->getElementsByTagName("Salon_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("salonNombre");
                if($data->length>0 && !SalonDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSalonNombre($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Salons>";
                $xml .= $this->toXML();
            $xml .= "</Salons>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Salons>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Salons>";
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