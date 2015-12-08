<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.OBJETO_PERDIDO_ENTITY;

    class ObjetoPerdidoDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "objeto_perdido";
        public static $PRIMARY_KEY_DB_NAME = "objeto_perdido_id";

        public static $ORDER_BY_OBJETO_PERDIDO_ELEMENTO = "objeto_perdido_elemento";
        public static $ORDER_BY_OBJETO_PERDIDO_FECHA = "objeto_perdido_fecha";
        public static $ORDER_BY_OBJETO_PERDIDO_CORREO = "objeto_perdido_correo";
        public static $ORDER_BY_OBJETO_PERDIDO_FECHA_DEVOLUCION = "objeto_perdido_fecha_devolucion";
        public static $ORDER_BY_OBJETO_PERDIDO_COMENTARIOS = "objeto_perdido_comentarios";
        public static $ORDER_BY_OBJETO_PERDIDO_SALON = "objeto_perdido_salon";
        public static $ORDER_BY_OBJETO_PERDIDO_ESTUDIANTE = "objeto_perdido_estudiante";

        # Constantes públicas para soporte de interfaz

        public $OBJETO_PERDIDO_ELEMENTO = "OBJETO_PERDIDO_ELEMENTO";
        public $OBJETO_PERDIDO_FECHA = "OBJETO_PERDIDO_FECHA";
        public $OBJETO_PERDIDO_CORREO = "OBJETO_PERDIDO_CORREO";
        public $OBJETO_PERDIDO_FECHA_DEVOLUCION = "OBJETO_PERDIDO_FECHA_DEVOLUCION";
        public $OBJETO_PERDIDO_COMENTARIOS = "OBJETO_PERDIDO_COMENTARIOS";
        public $OBJETO_PERDIDO_SALON = "OBJETO_PERDIDO_SALON";
        public $OBJETO_PERDIDO_ESTUDIANTE = "OBJETO_PERDIDO_ESTUDIANTE";

        # Atributos privados estandar
        private $id;
        private $objetoPerdidoElemento;
        private $objetoPerdidoFecha;
        private $objetoPerdidoCorreo;
        private $objetoPerdidoFechaDevolucion;
        private $objetoPerdidoComentarios;
        private $objetoPerdidoSalon;
        private $objetoPerdidoEstudiante;

        function ObjetoPerdidoDTO($id = null, $objetoPerdidoElemento = null, $objetoPerdidoFecha = null, $objetoPerdidoCorreo = null, $objetoPerdidoFechaDevolucion = null, $objetoPerdidoComentarios = null, $objetoPerdidoSalon = null, $objetoPerdidoEstudiante = null){
            $this->id = $id;
            $this->objetoPerdidoElemento = $objetoPerdidoElemento;
            $this->objetoPerdidoFecha = $objetoPerdidoFecha;
            $this->objetoPerdidoCorreo = $objetoPerdidoCorreo;
            $this->objetoPerdidoFechaDevolucion = $objetoPerdidoFechaDevolucion;
            $this->objetoPerdidoComentarios = $objetoPerdidoComentarios;
            $this->objetoPerdidoSalon = $objetoPerdidoSalon;
            $this->objetoPerdidoEstudiante = $objetoPerdidoEstudiante;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getObjetoPerdidoElemento(){
            return $this->objetoPerdidoElemento;
        }

        public function setObjetoPerdidoElemento($objetoPerdidoElemento){
            $this->objetoPerdidoElemento = $objetoPerdidoElemento;
        }

        public function getObjetoPerdidoFecha(){
            return $this->objetoPerdidoFecha;
        }

        public function setObjetoPerdidoFecha($objetoPerdidoFecha){
            $this->objetoPerdidoFecha = $objetoPerdidoFecha;
        }

        public function getObjetoPerdidoCorreo(){
            return $this->objetoPerdidoCorreo;
        }

        public function setObjetoPerdidoCorreo($objetoPerdidoCorreo){
            $this->objetoPerdidoCorreo = $objetoPerdidoCorreo;
        }

        public function getObjetoPerdidoFechaDevolucion(){
            return $this->objetoPerdidoFechaDevolucion;
        }

        public function setObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion){
            $this->objetoPerdidoFechaDevolucion = $objetoPerdidoFechaDevolucion;
        }

        public function getObjetoPerdidoComentarios(){
            return $this->objetoPerdidoComentarios;
        }

        public function setObjetoPerdidoComentarios($objetoPerdidoComentarios){
            $this->objetoPerdidoComentarios = $objetoPerdidoComentarios;
        }

        public function getObjetoPerdidoSalon(){
            return $this->objetoPerdidoSalon;
        }

        public function setObjetoPerdidoSalon($objetoPerdidoSalon){
            $this->objetoPerdidoSalon = $objetoPerdidoSalon;
        }

        public function getObjetoPerdidoEstudiante(){
            return $this->objetoPerdidoEstudiante;
        }

        public function setObjetoPerdidoEstudiante($objetoPerdidoEstudiante){
            $this->objetoPerdidoEstudiante = $objetoPerdidoEstudiante;
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
            $this->objetoPerdidoElemento = $entity->unscapeString($entity->getObjetoPerdidoElemento());
            $this->objetoPerdidoFecha = $entity->unscapeString($entity->getObjetoPerdidoFecha());
            $this->objetoPerdidoCorreo = $entity->unscapeString($entity->getObjetoPerdidoCorreo());
            $this->objetoPerdidoFechaDevolucion = $entity->unscapeString($entity->getObjetoPerdidoFechaDevolucion());
            $this->objetoPerdidoComentarios = $entity->unscapeString($entity->getObjetoPerdidoComentarios());
            $this->objetoPerdidoSalon = $entity->unscapeString($entity->getObjetoPerdidoSalon());
            $this->objetoPerdidoEstudiante = $entity->unscapeString($entity->getObjetoPerdidoEstudiante());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new ObjetoPerdidoDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(ObjetoPerdidoDTO $objetoPerdidoDTO){
            $objetoPerdido = new ObjetoPerdido();
            $objetoPerdido->setId($objetoPerdidoDTO->getId());
            $objetoPerdido->setObjetoPerdidoElemento($objetoPerdidoDTO->getObjetoPerdidoElemento());
            $objetoPerdido->setObjetoPerdidoFecha($objetoPerdidoDTO->getObjetoPerdidoFecha());
            $objetoPerdido->setObjetoPerdidoCorreo($objetoPerdidoDTO->getObjetoPerdidoCorreo());
            $objetoPerdido->setObjetoPerdidoFechaDevolucion($objetoPerdidoDTO->getObjetoPerdidoFechaDevolucion());
            $objetoPerdido->setObjetoPerdidoComentarios($objetoPerdidoDTO->getObjetoPerdidoComentarios());
            $objetoPerdido->setObjetoPerdidoSalon($objetoPerdidoDTO->getObjetoPerdidoSalon());
            $objetoPerdido->setObjetoPerdidoEstudiante($objetoPerdidoDTO->getObjetoPerdidoEstudiante());
            return $objetoPerdido;
        }

        public function isEntityValid(){
            $otherValidations = true;
            if($this->objetoPerdidoEstudiante !== null){
                $otherValidations = $otherValidations &&  EntityValidator::validateId($this->objetoPerdidoEstudiante);
            }
            return $otherValidations && EntityValidator::validateString($this->objetoPerdidoElemento) && EntityValidator::validateString($this->objetoPerdidoFecha) && EntityValidator::validateString($this->objetoPerdidoCorreo) && EntityValidator::validateString($this->objetoPerdidoFechaDevolucion) && EntityValidator::validateId($this->objetoPerdidoSalon);
        }
        public function toXML(){
            $xml="";
            $xml .= "<ObjetoPerdido>";
                $xml .= "<ObjetoPerdido_Id>";
                    $xml .= $this->getId();
                $xml .= "</ObjetoPerdido_Id>";
                if($this->getObjetoPerdidoElemento() !== null){
                    $xml .= "<objetoPerdidoElemento><![CDATA[";
                        $xml .= $this->getObjetoPerdidoElemento();
                    $xml .= "]]></objetoPerdidoElemento>";
                }
                if($this->getObjetoPerdidoFecha() !== null){
                    $xml .= "<objetoPerdidoFecha><![CDATA[";
                        $xml .= $this->getObjetoPerdidoFecha();
                    $xml .= "]]></objetoPerdidoFecha>";
                }
                if($this->getObjetoPerdidoCorreo() !== null){
                    $xml .= "<objetoPerdidoCorreo><![CDATA[";
                        $xml .= $this->getObjetoPerdidoCorreo();
                    $xml .= "]]></objetoPerdidoCorreo>";
                }
                if($this->getObjetoPerdidoFechaDevolucion() !== null){
                    $xml .= "<objetoPerdidoFechaDevolucion><![CDATA[";
                        $xml .= $this->getObjetoPerdidoFechaDevolucion();
                    $xml .= "]]></objetoPerdidoFechaDevolucion>";
                }
                if($this->getObjetoPerdidoComentarios() !== null){
                    $xml .= "<objetoPerdidoComentarios><![CDATA[";
                        $xml .= $this->getObjetoPerdidoComentarios();
                    $xml .= "]]></objetoPerdidoComentarios>";
                }
                if($this->objetoPerdidoSalon !== null){
                    $xml .= "<objetoPerdidoSalon>";
                        $xml .= "<objetoPerdidoSalon_id>";
                            $xml .= $this->objetoPerdidoSalon;
                        $xml .= "</objetoPerdidoSalon_id>";
                    $xml .= "</objetoPerdidoSalon>";
                }
                if($this->objetoPerdidoEstudiante !== null){
                    $xml .= "<objetoPerdidoEstudiante>";
                        $xml .= "<objetoPerdidoEstudiante_id>";
                            $xml .= $this->objetoPerdidoEstudiante;
                        $xml .= "</objetoPerdidoEstudiante_id>";
                    $xml .= "</objetoPerdidoEstudiante>";
                }
            $xml .= "</ObjetoPerdido>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("ObjetoPerdido");
            foreach ($nodes as $node) {
                $dao = new ObjetoPerdidoDTO();
                $data = $node->getElementsByTagName("ObjetoPerdido_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("objetoPerdidoElemento");
                if($data->length>0 && !ObjetoPerdidoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setObjetoPerdidoElemento($data);
                $data = $node->getElementsByTagName("objetoPerdidoFecha");
                if($data->length>0 && !ObjetoPerdidoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setObjetoPerdidoFecha($data);
                $data = $node->getElementsByTagName("objetoPerdidoCorreo");
                if($data->length>0 && !ObjetoPerdidoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setObjetoPerdidoCorreo($data);
                $data = $node->getElementsByTagName("objetoPerdidoFechaDevolucion");
                if($data->length>0 && !ObjetoPerdidoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setObjetoPerdidoFechaDevolucion($data);
                $data = $node->getElementsByTagName("objetoPerdidoComentarios");
                if($data->length>0 && !ObjetoPerdidoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setObjetoPerdidoComentarios($data);
                $data = $node->getElementsByTagName("objetoPerdidoSalon");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setObjetoPerdidoSalon($data);
                $data = $node->getElementsByTagName("objetoPerdidoEstudiante");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setObjetoPerdidoEstudiante($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<ObjetoPerdidos>";
                $xml .= $this->toXML();
            $xml .= "</ObjetoPerdidos>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<ObjetoPerdidos>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</ObjetoPerdidos>";
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