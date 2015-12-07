<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.OBJETO_EN_INVENTARIO_ENTITY;

    class ObjetoEnInventarioDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "objeto_en_inventario";
        public static $PRIMARY_KEY_DB_NAME = "objeto_en_inventario_id";

        public static $ORDER_BY_INVENTARIO_ELEMENTO = "inventario_elemento";
        public static $ORDER_BY_INVENTARIO_NUMERO_SERIE = "inventario_numero_serie";
        public static $ORDER_BY_INVENTARIO_SALON = "inventario_salon";
        public static $ORDER_BY_COMPUTADORA = "computadora_id";

        # Constantes públicas para soporte de interfaz

        public $INVENTARIO_ELEMENTO = "INVENTARIO_ELEMENTO";
        public $INVENTARIO_NUMERO_SERIE = "INVENTARIO_NUMERO_SERIE";
        public $INVENTARIO_SALON = "INVENTARIO_SALON";
        public $COMPUTADORA = "COMPUTADORA";

        # Atributos privados estandar
        private $id;
        private $inventarioElemento;
        private $inventarioNumeroSerie;
        private $inventarioSalon;
        private $computadora;

        function ObjetoEnInventarioDTO($id = null, $inventarioElemento = null, $inventarioNumeroSerie = null, $inventarioSalon = null, $computadora = null){
            $this->id = $id;
            $this->inventarioElemento = $inventarioElemento;
            $this->inventarioNumeroSerie = $inventarioNumeroSerie;
            $this->inventarioSalon = $inventarioSalon;
            $this->computadora = $computadora;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getInventarioElemento(){
            return $this->inventarioElemento;
        }

        public function setInventarioElemento($inventarioElemento){
            $this->inventarioElemento = $inventarioElemento;
        }

        public function getInventarioNumeroSerie(){
            return $this->inventarioNumeroSerie;
        }

        public function setInventarioNumeroSerie($inventarioNumeroSerie){
            $this->inventarioNumeroSerie = $inventarioNumeroSerie;
        }

        public function getInventarioSalon(){
            return $this->inventarioSalon;
        }

        public function setInventarioSalon($inventarioSalon){
            $this->inventarioSalon = $inventarioSalon;
        }

        public function getComputadora(){
            return $this->computadora;
        }

        public function setComputadora($computadora){
            $this->computadora = $computadora;
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
            $this->inventarioElemento = $entity->unscapeString($entity->getInventarioElemento());
            $this->inventarioNumeroSerie = $entity->unscapeString($entity->getInventarioNumeroSerie());
            $this->inventarioSalon = $entity->unscapeString($entity->getInventarioSalon());
            $this->computadora = $entity->unscapeString($entity->getComputadora());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new ObjetoEnInventarioDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(ObjetoEnInventarioDTO $objetoEnInventarioDTO){
            $objetoEnInventario = new ObjetoEnInventario();
            $objetoEnInventario->setId($objetoEnInventarioDTO->getId());
            $objetoEnInventario->setInventarioElemento($objetoEnInventarioDTO->getInventarioElemento());
            $objetoEnInventario->setInventarioNumeroSerie($objetoEnInventarioDTO->getInventarioNumeroSerie());
            $objetoEnInventario->setInventarioSalon($objetoEnInventarioDTO->getInventarioSalon());
            $objetoEnInventario->setComputadora($objetoEnInventarioDTO->getComputadora());
            return $objetoEnInventario;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->inventarioElemento) && EntityValidator::validateString($this->inventarioNumeroSerie) && EntityValidator::validateId($this->inventarioSalon) && EntityValidator::validateId($this->computadora);
        }
        public function toXML(){
            $xml="";
            $xml .= "<ObjetoEnInventario>";
                $xml .= "<ObjetoEnInventario_Id>";
                    $xml .= $this->getId();
                $xml .= "</ObjetoEnInventario_Id>";
                if($this->getInventarioElemento() !== null){
                    $xml .= "<inventarioElemento><![CDATA[";
                        $xml .= $this->getInventarioElemento();
                    $xml .= "]]></inventarioElemento>";
                }
                if($this->getInventarioNumeroSerie() !== null){
                    $xml .= "<inventarioNumeroSerie><![CDATA[";
                        $xml .= $this->getInventarioNumeroSerie();
                    $xml .= "]]></inventarioNumeroSerie>";
                }
                if($this->inventarioSalon !== null){
                    $xml .= "<inventarioSalon>";
                        $xml .= "<inventarioSalon_id>";
                            $xml .= $this->inventarioSalon;
                        $xml .= "</inventarioSalon_id>";
                    $xml .= "</inventarioSalon>";
                }
                if($this->computadora !== null){
                    $xml .= "<computadora>";
                        $xml .= "<computadora_id>";
                            $xml .= $this->computadora;
                        $xml .= "</computadora_id>";
                    $xml .= "</computadora>";
                }
            $xml .= "</ObjetoEnInventario>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("ObjetoEnInventario");
            foreach ($nodes as $node) {
                $dao = new ObjetoEnInventarioDTO();
                $data = $node->getElementsByTagName("ObjetoEnInventario_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("inventarioElemento");
                if($data->length>0 && !ObjetoEnInventarioDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setInventarioElemento($data);
                $data = $node->getElementsByTagName("inventarioNumeroSerie");
                if($data->length>0 && !ObjetoEnInventarioDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setInventarioNumeroSerie($data);
                $data = $node->getElementsByTagName("inventarioSalon");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setInventarioSalon($data);
                $data = $node->getElementsByTagName("computadora");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadora($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<ObjetoEnInventarios>";
                $xml .= $this->toXML();
            $xml .= "</ObjetoEnInventarios>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<ObjetoEnInventarios>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</ObjetoEnInventarios>";
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