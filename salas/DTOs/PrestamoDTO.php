<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.PRESTAMO_ENTITY;

    class PrestamoDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "prestamo";
        public static $PRIMARY_KEY_DB_NAME = "prestamo_id";

        public static $ORDER_BY_PRESTAMO_ENTRADA = "prestamo_entrada";
        public static $ORDER_BY_PRESTAMO_SALIDA = "prestamo_salida";
        public static $ORDER_BY_PRESTAMO_COMENTARIOS = "prestamo_comentarios";
        public static $ORDER_BY_PRESTAMO_ESTUDIANTE = "prestamo_estudiante";
        public static $ORDER_BY_PRESTAMO_COMPUTADORA = "prestamo_computadora";

        # Constantes públicas para soporte de interfaz

        public $PRESTAMO_ENTRADA = "PRESTAMO_ENTRADA";
        public $PRESTAMO_SALIDA = "PRESTAMO_SALIDA";
        public $PRESTAMO_COMENTARIOS = "PRESTAMO_COMENTARIOS";
        public $PRESTAMO_ESTUDIANTE = "PRESTAMO_ESTUDIANTE";
        public $PRESTAMO_COMPUTADORA = "PRESTAMO_COMPUTADORA";

        # Atributos privados estandar
        private $id;
        private $prestamoEntrada;
        private $prestamoSalida;
        private $prestamoComentarios;
        private $prestamoEstudiante;
        private $prestamoComputadora;

        function PrestamoDTO($id = null, $prestamoEntrada = null, $prestamoSalida = null, $prestamoComentarios = null, $prestamoEstudiante = null, $prestamoComputadora = null){
            $this->id = $id;
            $this->prestamoEntrada = $prestamoEntrada;
            $this->prestamoSalida = $prestamoSalida;
            $this->prestamoComentarios = $prestamoComentarios;
            $this->prestamoEstudiante = $prestamoEstudiante;
            $this->prestamoComputadora = $prestamoComputadora;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getPrestamoEntrada(){
            return $this->prestamoEntrada;
        }

        public function setPrestamoEntrada($prestamoEntrada){
            $this->prestamoEntrada = $prestamoEntrada;
        }

        public function getPrestamoSalida(){
            return $this->prestamoSalida;
        }

        public function setPrestamoSalida($prestamoSalida){
            $this->prestamoSalida = $prestamoSalida;
        }

        public function getPrestamoComentarios(){
            return $this->prestamoComentarios;
        }

        public function setPrestamoComentarios($prestamoComentarios){
            $this->prestamoComentarios = $prestamoComentarios;
        }

        public function getPrestamoEstudiante(){
            return $this->prestamoEstudiante;
        }

        public function setPrestamoEstudiante($prestamoEstudiante){
            $this->prestamoEstudiante = $prestamoEstudiante;
        }

        public function getPrestamoComputadora(){
            return $this->prestamoComputadora;
        }

        public function setPrestamoComputadora($prestamoComputadora){
            $this->prestamoComputadora = $prestamoComputadora;
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
            $this->prestamoEntrada = $entity->unscapeString($entity->getPrestamoEntrada());
            $this->prestamoSalida = $entity->unscapeString($entity->getPrestamoSalida());
            $this->prestamoComentarios = $entity->unscapeString($entity->getPrestamoComentarios());
            $this->prestamoEstudiante = $entity->unscapeString($entity->getPrestamoEstudiante());
            $this->prestamoComputadora = $entity->unscapeString($entity->getPrestamoComputadora());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new PrestamoDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(PrestamoDTO $prestamoDTO){
            $prestamo = new Prestamo();
            $prestamo->setId($prestamoDTO->getId());
            $prestamo->setPrestamoEntrada($prestamoDTO->getPrestamoEntrada());
            $prestamo->setPrestamoSalida($prestamoDTO->getPrestamoSalida());
            $prestamo->setPrestamoComentarios($prestamoDTO->getPrestamoComentarios());
            $prestamo->setPrestamoEstudiante($prestamoDTO->getPrestamoEstudiante());
            $prestamo->setPrestamoComputadora($prestamoDTO->getPrestamoComputadora());
            return $prestamo;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->prestamoEntrada) && EntityValidator::validateString($this->prestamoSalida) && EntityValidator::validateId($this->prestamoEstudiante) && EntityValidator::validateId($this->prestamoComputadora);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Prestamo>";
                $xml .= "<Prestamo_Id>";
                    $xml .= $this->getId();
                $xml .= "</Prestamo_Id>";
                if($this->getPrestamoEntrada() !== null){
                    $xml .= "<prestamoEntrada><![CDATA[";
                        $xml .= $this->getPrestamoEntrada();
                    $xml .= "]]></prestamoEntrada>";
                }
                if($this->getPrestamoSalida() !== null){
                    $xml .= "<prestamoSalida><![CDATA[";
                        $xml .= $this->getPrestamoSalida();
                    $xml .= "]]></prestamoSalida>";
                }
                if($this->getPrestamoComentarios() !== null){
                    $xml .= "<prestamoComentarios><![CDATA[";
                        $xml .= $this->getPrestamoComentarios();
                    $xml .= "]]></prestamoComentarios>";
                }
                if($this->prestamoEstudiante !== null){
                    $xml .= "<prestamoEstudiante>";
                        $xml .= "<prestamoEstudiante_id>";
                            $xml .= $this->prestamoEstudiante;
                        $xml .= "</prestamoEstudiante_id>";
                    $xml .= "</prestamoEstudiante>";
                }
                if($this->prestamoComputadora !== null){
                    $xml .= "<prestamoComputadora>";
                        $xml .= "<prestamoComputadora_id>";
                            $xml .= $this->prestamoComputadora;
                        $xml .= "</prestamoComputadora_id>";
                    $xml .= "</prestamoComputadora>";
                }
            $xml .= "</Prestamo>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Prestamo");
            foreach ($nodes as $node) {
                $dao = new PrestamoDTO();
                $data = $node->getElementsByTagName("Prestamo_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("prestamoEntrada");
                if($data->length>0 && !PrestamoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoEntrada($data);
                $data = $node->getElementsByTagName("prestamoSalida");
                if($data->length>0 && !PrestamoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoSalida($data);
                $data = $node->getElementsByTagName("prestamoComentarios");
                if($data->length>0 && !PrestamoDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoComentarios($data);
                $data = $node->getElementsByTagName("prestamoEstudiante");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoEstudiante($data);
                $data = $node->getElementsByTagName("prestamoComputadora");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoComputadora($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Prestamos>";
                $xml .= $this->toXML();
            $xml .= "</Prestamos>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Prestamos>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Prestamos>";
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