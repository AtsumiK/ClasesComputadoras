<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.IMPRESION_ENTITY;

    class ImpresionDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "impresion";
        public static $PRIMARY_KEY_DB_NAME = "impresion_id";

        public static $ORDER_BY_IMPRESION_FECHA = "impresion_fecha";
        public static $ORDER_BY_IMPRESION_LUGAR = "impresion_lugar";
        public static $ORDER_BY_IMPRESION_ESTUDIANTE = "impresion_estudiante";

        # Constantes públicas para soporte de interfaz

        public $IMPRESION_FECHA = "IMPRESION_FECHA";
        public $IMPRESION_LUGAR = "IMPRESION_LUGAR";
        public $IMPRESION_ESTUDIANTE = "IMPRESION_ESTUDIANTE";

        # Atributos privados estandar
        private $id;
        private $impresionFecha;
        private $impresionLugar;
        private $impresionEstudiante;

        function ImpresionDTO($id = null, $impresionFecha = null, $impresionLugar = null, $impresionEstudiante = null){
            $this->id = $id;
            $this->impresionFecha = $impresionFecha;
            $this->impresionLugar = $impresionLugar;
            $this->impresionEstudiante = $impresionEstudiante;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getImpresionFecha(){
            return $this->impresionFecha;
        }

        public function setImpresionFecha($impresionFecha){
            $this->impresionFecha = $impresionFecha;
        }

        public function getImpresionLugar(){
            return $this->impresionLugar;
        }

        public function setImpresionLugar($impresionLugar){
            $this->impresionLugar = $impresionLugar;
        }

        public function getImpresionEstudiante(){
            return $this->impresionEstudiante;
        }

        public function setImpresionEstudiante($impresionEstudiante){
            $this->impresionEstudiante = $impresionEstudiante;
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
            $this->impresionFecha = $entity->unscapeString($entity->getImpresionFecha());
            $this->impresionLugar = $entity->unscapeString($entity->getImpresionLugar());
            $this->impresionEstudiante = $entity->unscapeString($entity->getImpresionEstudiante());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new ImpresionDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(ImpresionDTO $impresionDTO){
            $impresion = new Impresion();
            $impresion->setId($impresionDTO->getId());
            $impresion->setImpresionFecha($impresionDTO->getImpresionFecha());
            $impresion->setImpresionLugar($impresionDTO->getImpresionLugar());
            $impresion->setImpresionEstudiante($impresionDTO->getImpresionEstudiante());
            return $impresion;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->impresionFecha) && EntityValidator::validateString($this->impresionLugar) && EntityValidator::validateId($this->impresionEstudiante);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Impresion>";
                $xml .= "<Impresion_Id>";
                    $xml .= $this->getId();
                $xml .= "</Impresion_Id>";
                if($this->getImpresionFecha() !== null){
                    $xml .= "<impresionFecha><![CDATA[";
                        $xml .= $this->getImpresionFecha();
                    $xml .= "]]></impresionFecha>";
                }
                if($this->getImpresionLugar() !== null){
                    $xml .= "<impresionLugar><![CDATA[";
                        $xml .= $this->getImpresionLugar();
                    $xml .= "]]></impresionLugar>";
                }
                if($this->impresionEstudiante !== null){
                    $xml .= "<impresionEstudiante>";
                        $xml .= "<impresionEstudiante_id>";
                            $xml .= $this->impresionEstudiante;
                        $xml .= "</impresionEstudiante_id>";
                    $xml .= "</impresionEstudiante>";
                }
            $xml .= "</Impresion>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Impresion");
            foreach ($nodes as $node) {
                $dao = new ImpresionDTO();
                $data = $node->getElementsByTagName("Impresion_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("impresionFecha");
                if($data->length>0 && !ImpresionDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setImpresionFecha($data);
                $data = $node->getElementsByTagName("impresionLugar");
                if($data->length>0 && !ImpresionDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setImpresionLugar($data);
                $data = $node->getElementsByTagName("impresionEstudiante");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setImpresionEstudiante($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Impresions>";
                $xml .= $this->toXML();
            $xml .= "</Impresions>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Impresions>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Impresions>";
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