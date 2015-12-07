<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_SOFTWARE_ENTITY;

    class ComputadoraSoftwareDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "computadora_software";
        public static $PRIMARY_KEY_DB_NAME = "computadora_software_id";

        public static $ORDER_BY_NUMERO_SERIE_PROGRAMA = "numero_serie_programa";
        public static $ORDER_BY_COMP_SOFT_FECHA_INSTALACION = "comp_soft_fecha_instalacion";
        public static $ORDER_BY_COMPUTADORA = "computadora";
        public static $ORDER_BY_SOFTWARE = "software";

        # Constantes públicas para soporte de interfaz

        public $NUMERO_SERIE_PROGRAMA = "NUMERO_SERIE_PROGRAMA";
        public $COMP_SOFT_FECHA_INSTALACION = "COMP_SOFT_FECHA_INSTALACION";
        public $COMPUTADORA = "COMPUTADORA";
        public $SOFTWARE = "SOFTWARE";

        # Atributos privados estandar
        private $id;
        private $numeroSeriePrograma;
        private $compSoftFechaInstalacion;
        private $computadora;
        private $software;

        function ComputadoraSoftwareDTO($id = null, $numeroSeriePrograma = null, $compSoftFechaInstalacion = null, $computadora = null, $software = null){
            $this->id = $id;
            $this->numeroSeriePrograma = $numeroSeriePrograma;
            $this->compSoftFechaInstalacion = $compSoftFechaInstalacion;
            $this->computadora = $computadora;
            $this->software = $software;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getNumeroSeriePrograma(){
            return $this->numeroSeriePrograma;
        }

        public function setNumeroSeriePrograma($numeroSeriePrograma){
            $this->numeroSeriePrograma = $numeroSeriePrograma;
        }

        public function getCompSoftFechaInstalacion(){
            return $this->compSoftFechaInstalacion;
        }

        public function setCompSoftFechaInstalacion($compSoftFechaInstalacion){
            $this->compSoftFechaInstalacion = $compSoftFechaInstalacion;
        }

        public function getComputadora(){
            return $this->computadora;
        }

        public function setComputadora($computadora){
            $this->computadora = $computadora;
        }

        public function getSoftware(){
            return $this->software;
        }

        public function setSoftware($software){
            $this->software = $software;
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
            $this->numeroSeriePrograma = $entity->unscapeString($entity->getNumeroSeriePrograma());
            $this->compSoftFechaInstalacion = $entity->unscapeString($entity->getCompSoftFechaInstalacion());
            $this->computadora = $entity->unscapeString($entity->getComputadora());
            $this->software = $entity->unscapeString($entity->getSoftware());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new ComputadoraSoftwareDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(ComputadoraSoftwareDTO $computadoraSoftwareDTO){
            $computadoraSoftware = new ComputadoraSoftware();
            $computadoraSoftware->setId($computadoraSoftwareDTO->getId());
            $computadoraSoftware->setNumeroSeriePrograma($computadoraSoftwareDTO->getNumeroSeriePrograma());
            $computadoraSoftware->setCompSoftFechaInstalacion($computadoraSoftwareDTO->getCompSoftFechaInstalacion());
            $computadoraSoftware->setComputadora($computadoraSoftwareDTO->getComputadora());
            $computadoraSoftware->setSoftware($computadoraSoftwareDTO->getSoftware());
            return $computadoraSoftware;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->numeroSeriePrograma) && EntityValidator::validateId($this->computadora) && EntityValidator::validateId($this->software);
        }
        public function toXML(){
            $xml="";
            $xml .= "<ComputadoraSoftware>";
                $xml .= "<ComputadoraSoftware_Id>";
                    $xml .= $this->getId();
                $xml .= "</ComputadoraSoftware_Id>";
                if($this->getNumeroSeriePrograma() !== null){
                    $xml .= "<numeroSeriePrograma><![CDATA[";
                        $xml .= $this->getNumeroSeriePrograma();
                    $xml .= "]]></numeroSeriePrograma>";
                }
                if($this->getCompSoftFechaInstalacion() !== null){
                    $xml .= "<compSoftFechaInstalacion><![CDATA[";
                        $xml .= $this->getCompSoftFechaInstalacion();
                    $xml .= "]]></compSoftFechaInstalacion>";
                }
                if($this->computadora !== null){
                    $xml .= "<computadora>";
                        $xml .= "<computadora_id>";
                            $xml .= $this->computadora;
                        $xml .= "</computadora_id>";
                    $xml .= "</computadora>";
                }
                if($this->software !== null){
                    $xml .= "<software>";
                        $xml .= "<software_id>";
                            $xml .= $this->software;
                        $xml .= "</software_id>";
                    $xml .= "</software>";
                }
            $xml .= "</ComputadoraSoftware>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("ComputadoraSoftware");
            foreach ($nodes as $node) {
                $dao = new ComputadoraSoftwareDTO();
                $data = $node->getElementsByTagName("ComputadoraSoftware_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("numeroSeriePrograma");
                if($data->length>0 && !ComputadoraSoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setNumeroSeriePrograma($data);
                $data = $node->getElementsByTagName("compSoftFechaInstalacion");
                if($data->length>0 && !ComputadoraSoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setCompSoftFechaInstalacion($data);
                $data = $node->getElementsByTagName("computadora");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadora($data);
                $data = $node->getElementsByTagName("software");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftware($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<ComputadoraSoftwares>";
                $xml .= $this->toXML();
            $xml .= "</ComputadoraSoftwares>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<ComputadoraSoftwares>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</ComputadoraSoftwares>";
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