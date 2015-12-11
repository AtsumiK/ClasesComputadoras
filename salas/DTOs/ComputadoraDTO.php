<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;

    class ComputadoraDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "computadora";
        public static $PRIMARY_KEY_DB_NAME = "computadora_id";

        public static $ORDER_BY_COMPUTADORA_NOMBRE = "computadora_nombre";
        public static $ORDER_BY_COMPUTADORA_RAM = "computadora_ram";
        public static $ORDER_BY_COMPUTADORA_PROCESADOR = "computadora_procesador";
        public static $ORDER_BY_COMPUTADORA_DISCO_DURO = "computadora_disco_duro";
        public static $ORDER_BY_COMPUTADORA_DIR_IP = "computadora_dir_ip";
        public static $ORDER_BY_COMPUTADORA_DIR_MAC = "computadora_dir_mac";

        # Constantes públicas para soporte de interfaz

        public $COMPUTADORA_NOMBRE = "COMPUTADORA_NOMBRE";
        public $COMPUTADORA_RAM = "COMPUTADORA_RAM";
        public $COMPUTADORA_PROCESADOR = "COMPUTADORA_PROCESADOR";
        public $COMPUTADORA_DISCO_DURO = "COMPUTADORA_DISCO_DURO";
        public $COMPUTADORA_DIR_IP = "COMPUTADORA_DIR_IP";
        public $COMPUTADORA_DIR_MAC = "COMPUTADORA_DIR_MAC";
        public $COMPUTAORA_OBJETOS_INVENTARIO = "COMPUTAORA_OBJETOS_INVENTARIO";

        # Atributos privados estandar
        private $id;
        private $computadoraNombre;
        private $computadoraRam;
        private $computadoraProcesador;
        private $computadoraDiscoDuro;
        private $computadoraDirIp;
        private $computadoraDirMac;
        private $computaoraObjetosInventario;

        function ComputadoraDTO($id = null, $computadoraNombre = null, $computadoraRam = null, $computadoraProcesador = null, $computadoraDiscoDuro = null, $computadoraDirIp = null, $computadoraDirMac = null, array $computaoraObjetosInventario = null){
            $this->id = $id;
            $this->computadoraNombre = $computadoraNombre;
            $this->computadoraRam = $computadoraRam;
            $this->computadoraProcesador = $computadoraProcesador;
            $this->computadoraDiscoDuro = $computadoraDiscoDuro;
            $this->computadoraDirIp = $computadoraDirIp;
            $this->computadoraDirMac = $computadoraDirMac;
            $this->computaoraObjetosInventario = $computaoraObjetosInventario;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getComputadoraNombre(){
            return $this->computadoraNombre;
        }

        public function setComputadoraNombre($computadoraNombre){
            $this->computadoraNombre = $computadoraNombre;
        }

        public function getComputadoraRam(){
            return $this->computadoraRam;
        }

        public function setComputadoraRam($computadoraRam){
            $this->computadoraRam = $computadoraRam;
        }

        public function getComputadoraProcesador(){
            return $this->computadoraProcesador;
        }

        public function setComputadoraProcesador($computadoraProcesador){
            $this->computadoraProcesador = $computadoraProcesador;
        }

        public function getComputadoraDiscoDuro(){
            return $this->computadoraDiscoDuro;
        }

        public function setComputadoraDiscoDuro($computadoraDiscoDuro){
            $this->computadoraDiscoDuro = $computadoraDiscoDuro;
        }

        public function getComputadoraDirIp(){
            return $this->computadoraDirIp;
        }

        public function setComputadoraDirIp($computadoraDirIp){
            $this->computadoraDirIp = $computadoraDirIp;
        }

        public function getComputadoraDirMac(){
            return $this->computadoraDirMac;
        }

        public function setComputadoraDirMac($computadoraDirMac){
            $this->computadoraDirMac = $computadoraDirMac;
        }

        public function getComputaoraObjetosInventario(){
            return $this->computaoraObjetosInventario;
        }

        public function setComputaoraObjetosInventario(array $computaoraObjetosInventario){
            $this->computaoraObjetosInventario = $computaoraObjetosInventario;
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
            $this->computadoraNombre = $entity->unscapeString($entity->getComputadoraNombre());
            $this->computadoraRam = $entity->unscapeString($entity->getComputadoraRam());
            $this->computadoraProcesador = $entity->unscapeString($entity->getComputadoraProcesador());
            $this->computadoraDiscoDuro = $entity->unscapeString($entity->getComputadoraDiscoDuro());
            $this->computadoraDirIp = $entity->unscapeString($entity->getComputadoraDirIp());
            $this->computadoraDirMac = $entity->unscapeString($entity->getComputadoraDirMac());
            $this->computaoraObjetosInventario = array();
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new ComputadoraDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(ComputadoraDTO $computadoraDTO){
            $computadora = new Computadora();
            $computadora->setId($computadoraDTO->getId());
            $computadora->setComputadoraNombre($computadoraDTO->getComputadoraNombre());
            $computadora->setComputadoraRam($computadoraDTO->getComputadoraRam());
            $computadora->setComputadoraProcesador($computadoraDTO->getComputadoraProcesador());
            $computadora->setComputadoraDiscoDuro($computadoraDTO->getComputadoraDiscoDuro());
            $computadora->setComputadoraDirIp($computadoraDTO->getComputadoraDirIp());
            $computadora->setComputadoraDirMac($computadoraDTO->getComputadoraDirMac());
            $computadora->setComputaoraObjetosInventario(array());
            return $computadora;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->computadoraNombre) && EntityValidator::validateString($this->computadoraRam) && EntityValidator::validateString($this->computadoraProcesador) && EntityValidator::validateString($this->computadoraDiscoDuro);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Computadora>";
                $xml .= "<Computadora_Id>";
                    $xml .= $this->getId();
                $xml .= "</Computadora_Id>";
                if($this->getComputadoraNombre() !== null){
                    $xml .= "<computadoraNombre><![CDATA[";
                        $xml .= $this->getComputadoraNombre();
                    $xml .= "]]></computadoraNombre>";
                }
                if($this->getComputadoraRam() !== null){
                    $xml .= "<computadoraRam><![CDATA[";
                        $xml .= $this->getComputadoraRam();
                    $xml .= "]]></computadoraRam>";
                }
                if($this->getComputadoraProcesador() !== null){
                    $xml .= "<computadoraProcesador><![CDATA[";
                        $xml .= $this->getComputadoraProcesador();
                    $xml .= "]]></computadoraProcesador>";
                }
                if($this->getComputadoraDiscoDuro() !== null){
                    $xml .= "<computadoraDiscoDuro><![CDATA[";
                        $xml .= $this->getComputadoraDiscoDuro();
                    $xml .= "]]></computadoraDiscoDuro>";
                }
                if($this->getComputadoraDirIp() !== null){
                    $xml .= "<computadoraDirIp><![CDATA[";
                        $xml .= $this->getComputadoraDirIp();
                    $xml .= "]]></computadoraDirIp>";
                }
                if($this->getComputadoraDirMac() !== null){
                    $xml .= "<computadoraDirMac><![CDATA[";
                        $xml .= $this->getComputadoraDirMac();
                    $xml .= "]]></computadoraDirMac>";
                }
                if($this->computaoraObjetosInventario !== null){
                    $xml .= "<computaoraObjetosInventario>";
                    if(is_array($this->computaoraObjetosInventario)){
                        foreach($this->computaoraObjetosInventario as $obj){
                            $xml .= "<computaoraObjetosInventario_id>";
                                $xml .= $obj;
                            $xml .= "</computaoraObjetosInventario_id>";
                        }
                    }
                    $xml .= "</computaoraObjetosInventario>";
                }
            $xml .= "</Computadora>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Computadora");
            foreach ($nodes as $node) {
                $dao = new ComputadoraDTO();
                $data = $node->getElementsByTagName("Computadora_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("computadoraNombre");
                if($data->length>0 && !ComputadoraDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadoraNombre($data);
                $data = $node->getElementsByTagName("computadoraRam");
                if($data->length>0 && !ComputadoraDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadoraRam($data);
                $data = $node->getElementsByTagName("computadoraProcesador");
                if($data->length>0 && !ComputadoraDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadoraProcesador($data);
                $data = $node->getElementsByTagName("computadoraDiscoDuro");
                if($data->length>0 && !ComputadoraDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadoraDiscoDuro($data);
                $data = $node->getElementsByTagName("computadoraDirIp");
                if($data->length>0 && !ComputadoraDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadoraDirIp($data);
                $data = $node->getElementsByTagName("computadoraDirMac");
                if($data->length>0 && !ComputadoraDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadoraDirMac($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Computadoras>";
                $xml .= $this->toXML();
            $xml .= "</Computadoras>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Computadoras>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Computadoras>";
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