<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_SALON_ENTITY;

    class MonitorSalonDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "monitor_salon";
        public static $PRIMARY_KEY_DB_NAME = "monitor_salon_id";

        public static $ORDER_BY_MONITOR_SALON_ENTRADA = "monitor_salon_entrada";
        public static $ORDER_BY_MONITOR_SALON_SALIDA = "monitor_salon_salida";
        public static $ORDER_BY_MONITOR_SALON_COMENTARIOS = "monitor_salon_comentarios";
        public static $ORDER_BY_MONITOR = "monitor";
        public static $ORDER_BY_SALON = "salon";

        # Constantes públicas para soporte de interfaz

        public $MONITOR_SALON_ENTRADA = "MONITOR_SALON_ENTRADA";
        public $MONITOR_SALON_SALIDA = "MONITOR_SALON_SALIDA";
        public $MONITOR_SALON_COMENTARIOS = "MONITOR_SALON_COMENTARIOS";
        public $MONITOR = "MONITOR";
        public $SALON = "SALON";

        # Atributos privados estandar
        private $id;
        private $monitorSalonEntrada;
        private $monitorSalonSalida;
        private $monitorSalonComentarios;
        private $monitor;
        private $salon;

        function MonitorSalonDTO($id = null, $monitorSalonEntrada = null, $monitorSalonSalida = null, $monitorSalonComentarios = null, $monitor = null, $salon = null){
            $this->id = $id;
            $this->monitorSalonEntrada = $monitorSalonEntrada;
            $this->monitorSalonSalida = $monitorSalonSalida;
            $this->monitorSalonComentarios = $monitorSalonComentarios;
            $this->monitor = $monitor;
            $this->salon = $salon;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getMonitorSalonEntrada(){
            return $this->monitorSalonEntrada;
        }

        public function setMonitorSalonEntrada($monitorSalonEntrada){
            $this->monitorSalonEntrada = $monitorSalonEntrada;
        }

        public function getMonitorSalonSalida(){
            return $this->monitorSalonSalida;
        }

        public function setMonitorSalonSalida($monitorSalonSalida){
            $this->monitorSalonSalida = $monitorSalonSalida;
        }

        public function getMonitorSalonComentarios(){
            return $this->monitorSalonComentarios;
        }

        public function setMonitorSalonComentarios($monitorSalonComentarios){
            $this->monitorSalonComentarios = $monitorSalonComentarios;
        }

        public function getMonitor(){
            return $this->monitor;
        }

        public function setMonitor($monitor){
            $this->monitor = $monitor;
        }

        public function getSalon(){
            return $this->salon;
        }

        public function setSalon($salon){
            $this->salon = $salon;
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
            $this->monitorSalonEntrada = $entity->unscapeString($entity->getMonitorSalonEntrada());
            $this->monitorSalonSalida = $entity->unscapeString($entity->getMonitorSalonSalida());
            $this->monitorSalonComentarios = $entity->unscapeString($entity->getMonitorSalonComentarios());
            $this->monitor = $entity->unscapeString($entity->getMonitor());
            $this->salon = $entity->unscapeString($entity->getSalon());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new MonitorSalonDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(MonitorSalonDTO $monitorSalonDTO){
            $monitorSalon = new MonitorSalon();
            $monitorSalon->setId($monitorSalonDTO->getId());
            $monitorSalon->setMonitorSalonEntrada($monitorSalonDTO->getMonitorSalonEntrada());
            $monitorSalon->setMonitorSalonSalida($monitorSalonDTO->getMonitorSalonSalida());
            $monitorSalon->setMonitorSalonComentarios($monitorSalonDTO->getMonitorSalonComentarios());
            $monitorSalon->setMonitor($monitorSalonDTO->getMonitor());
            $monitorSalon->setSalon($monitorSalonDTO->getSalon());
            return $monitorSalon;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->monitorSalonEntrada) && EntityValidator::validateString($this->monitorSalonSalida) && EntityValidator::validateId($this->monitor) && EntityValidator::validateId($this->salon);
        }
        public function toXML(){
            $xml="";
            $xml .= "<MonitorSalon>";
                $xml .= "<MonitorSalon_Id>";
                    $xml .= $this->getId();
                $xml .= "</MonitorSalon_Id>";
                if($this->getMonitorSalonEntrada() !== null){
                    $xml .= "<monitorSalonEntrada><![CDATA[";
                        $xml .= $this->getMonitorSalonEntrada();
                    $xml .= "]]></monitorSalonEntrada>";
                }
                if($this->getMonitorSalonSalida() !== null){
                    $xml .= "<monitorSalonSalida><![CDATA[";
                        $xml .= $this->getMonitorSalonSalida();
                    $xml .= "]]></monitorSalonSalida>";
                }
                if($this->getMonitorSalonComentarios() !== null){
                    $xml .= "<monitorSalonComentarios><![CDATA[";
                        $xml .= $this->getMonitorSalonComentarios();
                    $xml .= "]]></monitorSalonComentarios>";
                }
                if($this->monitor !== null){
                    $xml .= "<monitor>";
                        $xml .= "<monitor_id>";
                            $xml .= $this->monitor;
                        $xml .= "</monitor_id>";
                    $xml .= "</monitor>";
                }
                if($this->salon !== null){
                    $xml .= "<salon>";
                        $xml .= "<salon_id>";
                            $xml .= $this->salon;
                        $xml .= "</salon_id>";
                    $xml .= "</salon>";
                }
            $xml .= "</MonitorSalon>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("MonitorSalon");
            foreach ($nodes as $node) {
                $dao = new MonitorSalonDTO();
                $data = $node->getElementsByTagName("MonitorSalon_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("monitorSalonEntrada");
                if($data->length>0 && !MonitorSalonDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setMonitorSalonEntrada($data);
                $data = $node->getElementsByTagName("monitorSalonSalida");
                if($data->length>0 && !MonitorSalonDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setMonitorSalonSalida($data);
                $data = $node->getElementsByTagName("monitorSalonComentarios");
                if($data->length>0 && !MonitorSalonDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setMonitorSalonComentarios($data);
                $data = $node->getElementsByTagName("monitor");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setMonitor($data);
                $data = $node->getElementsByTagName("salon");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSalon($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<MonitorSalons>";
                $xml .= $this->toXML();
            $xml .= "</MonitorSalons>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<MonitorSalons>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</MonitorSalons>";
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