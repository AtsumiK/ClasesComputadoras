<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_ENTITY;

    class MonitorDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "monitor";
        public static $PRIMARY_KEY_DB_NAME = "monitor_id";

        public static $ORDER_BY_MONITOR_TIPO = "monitor_tipo";
        public static $ORDER_BY_MONITOR_HORARIO = "monitor_horario";
        public static $ORDER_BY_MONITOR_ESTUDIANTE = "monitor_estudiante";

        # Constantes públicas para soporte de interfaz

        public $MONITOR_TIPO = "MONITOR_TIPO";
        public $MONITOR_HORARIO = "MONITOR_HORARIO";
        public $MONITOR_ESTUDIANTE = "MONITOR_ESTUDIANTE";

        # Atributos privados estandar
        private $id;
        private $monitorTipo;
        private $monitorHorario;
        private $monitorEstudiante;

        function MonitorDTO($id = null, $monitorTipo = null, $monitorHorario = null, $monitorEstudiante = null){
            $this->id = $id;
            $this->monitorTipo = $monitorTipo;
            $this->monitorHorario = $monitorHorario;
            $this->monitorEstudiante = $monitorEstudiante;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getMonitorTipo(){
            return $this->monitorTipo;
        }

        public function setMonitorTipo($monitorTipo){
            $this->monitorTipo = $monitorTipo;
        }

        public function getMonitorHorario(){
            return $this->monitorHorario;
        }

        public function setMonitorHorario($monitorHorario){
            $this->monitorHorario = $monitorHorario;
        }

        public function getMonitorEstudiante(){
            return $this->monitorEstudiante;
        }

        public function setMonitorEstudiante($monitorEstudiante){
            $this->monitorEstudiante = $monitorEstudiante;
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
            $this->monitorTipo = $entity->unscapeString($entity->getMonitorTipo());
            $this->monitorHorario = $entity->unscapeString($entity->getMonitorHorario());
            $this->monitorEstudiante = $entity->unscapeString($entity->getMonitorEstudiante());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new MonitorDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(MonitorDTO $monitorDTO){
            $monitor = new Monitor();
            $monitor->setId($monitorDTO->getId());
            $monitor->setMonitorTipo($monitorDTO->getMonitorTipo());
            $monitor->setMonitorHorario($monitorDTO->getMonitorHorario());
            $monitor->setMonitorEstudiante($monitorDTO->getMonitorEstudiante());
            return $monitor;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->monitorTipo) && EntityValidator::validateString($this->monitorHorario) && EntityValidator::validateId($this->monitorEstudiante);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Monitor>";
                $xml .= "<Monitor_Id>";
                    $xml .= $this->getId();
                $xml .= "</Monitor_Id>";
                if($this->getMonitorTipo() !== null){
                    $xml .= "<monitorTipo><![CDATA[";
                        $xml .= $this->getMonitorTipo();
                    $xml .= "]]></monitorTipo>";
                }
                if($this->getMonitorHorario() !== null){
                    $xml .= "<monitorHorario><![CDATA[";
                        $xml .= $this->getMonitorHorario();
                    $xml .= "]]></monitorHorario>";
                }
                if($this->monitorEstudiante !== null){
                    $xml .= "<monitorEstudiante>";
                        $xml .= "<monitorEstudiante_id>";
                            $xml .= $this->monitorEstudiante;
                        $xml .= "</monitorEstudiante_id>";
                    $xml .= "</monitorEstudiante>";
                }
            $xml .= "</Monitor>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Monitor");
            foreach ($nodes as $node) {
                $dao = new MonitorDTO();
                $data = $node->getElementsByTagName("Monitor_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("monitorTipo");
                if($data->length>0 && !MonitorDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setMonitorTipo($data);
                $data = $node->getElementsByTagName("monitorHorario");
                if($data->length>0 && !MonitorDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setMonitorHorario($data);
                $data = $node->getElementsByTagName("monitorEstudiante");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setMonitorEstudiante($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Monitors>";
                $xml .= $this->toXML();
            $xml .= "</Monitors>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Monitors>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Monitors>";
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