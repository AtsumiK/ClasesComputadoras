<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.TAREA_ENTITY;

    class TareaDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "tarea";
        public static $PRIMARY_KEY_DB_NAME = "tarea_id";

        public static $ORDER_BY_TAREA_DESCRIPCION = "tarea_descripcion";
        public static $ORDER_BY_TAREA_COMENTARIOS = "tarea_comentarios";
        public static $ORDER_BY_TAREA_FECHA_INICIO = "tarea_fecha_inicio";
        public static $ORDER_BY_TAREA_FECHA_FIN = "tarea_fecha_fin";
        public static $ORDER_BY_TAREA_MONITOR = "tarea_monitor";

        # Constantes públicas para soporte de interfaz

        public $TAREA_DESCRIPCION = "TAREA_DESCRIPCION";
        public $TAREA_COMENTARIOS = "TAREA_COMENTARIOS";
        public $TAREA_FECHA_INICIO = "TAREA_FECHA_INICIO";
        public $TAREA_FECHA_FIN = "TAREA_FECHA_FIN";
        public $TAREA_MONITOR = "TAREA_MONITOR";

        # Atributos privados estandar
        private $id;
        private $tareaDescripcion;
        private $tareaComentarios;
        private $tareaFechaInicio;
        private $tareaFechaFin;
        private $tareaMonitor;

        function TareaDTO($id = null, $tareaDescripcion = null, $tareaComentarios = null, $tareaFechaInicio = null, $tareaFechaFin = null, $tareaMonitor = null){
            $this->id = $id;
            $this->tareaDescripcion = $tareaDescripcion;
            $this->tareaComentarios = $tareaComentarios;
            $this->tareaFechaInicio = $tareaFechaInicio;
            $this->tareaFechaFin = $tareaFechaFin;
            $this->tareaMonitor = $tareaMonitor;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getTareaDescripcion(){
            return $this->tareaDescripcion;
        }

        public function setTareaDescripcion($tareaDescripcion){
            $this->tareaDescripcion = $tareaDescripcion;
        }

        public function getTareaComentarios(){
            return $this->tareaComentarios;
        }

        public function setTareaComentarios($tareaComentarios){
            $this->tareaComentarios = $tareaComentarios;
        }

        public function getTareaFechaInicio(){
            return $this->tareaFechaInicio;
        }

        public function setTareaFechaInicio($tareaFechaInicio){
            $this->tareaFechaInicio = $tareaFechaInicio;
        }

        public function getTareaFechaFin(){
            return $this->tareaFechaFin;
        }

        public function setTareaFechaFin($tareaFechaFin){
            $this->tareaFechaFin = $tareaFechaFin;
        }

        public function getTareaMonitor(){
            return $this->tareaMonitor;
        }

        public function setTareaMonitor($tareaMonitor){
            $this->tareaMonitor = $tareaMonitor;
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
            $this->tareaDescripcion = $entity->unscapeString($entity->getTareaDescripcion());
            $this->tareaComentarios = $entity->unscapeString($entity->getTareaComentarios());
            $this->tareaFechaInicio = $entity->unscapeString($entity->getTareaFechaInicio());
            $this->tareaFechaFin = $entity->unscapeString($entity->getTareaFechaFin());
            $this->tareaMonitor = $entity->unscapeString($entity->getTareaMonitor());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new TareaDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(TareaDTO $tareaDTO){
            $tarea = new Tarea();
            $tarea->setId($tareaDTO->getId());
            $tarea->setTareaDescripcion($tareaDTO->getTareaDescripcion());
            $tarea->setTareaComentarios($tareaDTO->getTareaComentarios());
            $tarea->setTareaFechaInicio($tareaDTO->getTareaFechaInicio());
            $tarea->setTareaFechaFin($tareaDTO->getTareaFechaFin());
            $tarea->setTareaMonitor($tareaDTO->getTareaMonitor());
            return $tarea;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->tareaDescripcion) && EntityValidator::validateString($this->tareaComentarios) && EntityValidator::validateString($this->tareaFechaInicio) && EntityValidator::validateString($this->tareaFechaFin) && EntityValidator::validateId($this->tareaMonitor);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Tarea>";
                $xml .= "<Tarea_Id>";
                    $xml .= $this->getId();
                $xml .= "</Tarea_Id>";
                if($this->getTareaDescripcion() !== null){
                    $xml .= "<tareaDescripcion><![CDATA[";
                        $xml .= $this->getTareaDescripcion();
                    $xml .= "]]></tareaDescripcion>";
                }
                if($this->getTareaComentarios() !== null){
                    $xml .= "<tareaComentarios><![CDATA[";
                        $xml .= $this->getTareaComentarios();
                    $xml .= "]]></tareaComentarios>";
                }
                if($this->getTareaFechaInicio() !== null){
                    $xml .= "<tareaFechaInicio><![CDATA[";
                        $xml .= $this->getTareaFechaInicio();
                    $xml .= "]]></tareaFechaInicio>";
                }
                if($this->getTareaFechaFin() !== null){
                    $xml .= "<tareaFechaFin><![CDATA[";
                        $xml .= $this->getTareaFechaFin();
                    $xml .= "]]></tareaFechaFin>";
                }
                if($this->tareaMonitor !== null){
                    $xml .= "<tareaMonitor>";
                        $xml .= "<tareaMonitor_id>";
                            $xml .= $this->tareaMonitor;
                        $xml .= "</tareaMonitor_id>";
                    $xml .= "</tareaMonitor>";
                }
            $xml .= "</Tarea>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Tarea");
            foreach ($nodes as $node) {
                $dao = new TareaDTO();
                $data = $node->getElementsByTagName("Tarea_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("tareaDescripcion");
                if($data->length>0 && !TareaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setTareaDescripcion($data);
                $data = $node->getElementsByTagName("tareaComentarios");
                if($data->length>0 && !TareaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setTareaComentarios($data);
                $data = $node->getElementsByTagName("tareaFechaInicio");
                if($data->length>0 && !TareaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setTareaFechaInicio($data);
                $data = $node->getElementsByTagName("tareaFechaFin");
                if($data->length>0 && !TareaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setTareaFechaFin($data);
                $data = $node->getElementsByTagName("tareaMonitor");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setTareaMonitor($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Tareas>";
                $xml .= $this->toXML();
            $xml .= "</Tareas>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Tareas>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Tareas>";
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