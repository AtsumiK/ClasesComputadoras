<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_ENTITY;

    class SoftwareDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "software";
        public static $PRIMARY_KEY_DB_NAME = "software_id";

        public static $ORDER_BY_SOFTWARE_NUMERO_SERIE = "software_numero_serie";
        public static $ORDER_BY_SOFTWARE_NOMBRE = "software_nombre";
        public static $ORDER_BY_SOFTWARE_VERSION = "software_version";
        public static $ORDER_BY_SOFTWARE_FECHA_CADUCIDAD = "software_fecha_caducidad";
        public static $ORDER_BY_SOFTWARE_FECHA_AQUISICION = "software_fecha_aquisicion";
        public static $ORDER_BY_SOFTWARE_EQUIPOS_PERMITIDOS = "software_equipos_permitidos";
        public static $ORDER_BY_SOFTWARE_COMENTARIOS = "software_comentarios";

        # Constantes públicas para soporte de interfaz

        public $SOFTWARE_NUMERO_SERIE = "SOFTWARE_NUMERO_SERIE";
        public $SOFTWARE_NOMBRE = "SOFTWARE_NOMBRE";
        public $SOFTWARE_VERSION = "SOFTWARE_VERSION";
        public $SOFTWARE_FECHA_CADUCIDAD = "SOFTWARE_FECHA_CADUCIDAD";
        public $SOFTWARE_FECHA_AQUISICION = "SOFTWARE_FECHA_AQUISICION";
        public $SOFTWARE_EQUIPOS_PERMITIDOS = "SOFTWARE_EQUIPOS_PERMITIDOS";
        public $SOFTWARE_COMENTARIOS = "SOFTWARE_COMENTARIOS";

        # Atributos privados estandar
        private $id;
        private $softwareNumeroSerie;
        private $softwareNombre;
        private $softwareVersion;
        private $softwareFechaCaducidad;
        private $softwareFechaAquisicion;
        private $softwareEquiposPermitidos;
        private $softwareComentarios;

        function SoftwareDTO($id = null, $softwareNumeroSerie = null, $softwareNombre = null, $softwareVersion = null, $softwareFechaCaducidad = null, $softwareFechaAquisicion = null, $softwareEquiposPermitidos = null, $softwareComentarios = null){
            $this->id = $id;
            $this->softwareNumeroSerie = $softwareNumeroSerie;
            $this->softwareNombre = $softwareNombre;
            $this->softwareVersion = $softwareVersion;
            $this->softwareFechaCaducidad = $softwareFechaCaducidad;
            $this->softwareFechaAquisicion = $softwareFechaAquisicion;
            $this->softwareEquiposPermitidos = $softwareEquiposPermitidos;
            $this->softwareComentarios = $softwareComentarios;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getSoftwareNumeroSerie(){
            return $this->softwareNumeroSerie;
        }

        public function setSoftwareNumeroSerie($softwareNumeroSerie){
            $this->softwareNumeroSerie = $softwareNumeroSerie;
        }

        public function getSoftwareNombre(){
            return $this->softwareNombre;
        }

        public function setSoftwareNombre($softwareNombre){
            $this->softwareNombre = $softwareNombre;
        }

        public function getSoftwareVersion(){
            return $this->softwareVersion;
        }

        public function setSoftwareVersion($softwareVersion){
            $this->softwareVersion = $softwareVersion;
        }

        public function getSoftwareFechaCaducidad(){
            return $this->softwareFechaCaducidad;
        }

        public function setSoftwareFechaCaducidad($softwareFechaCaducidad){
            $this->softwareFechaCaducidad = $softwareFechaCaducidad;
        }

        public function getSoftwareFechaAquisicion(){
            return $this->softwareFechaAquisicion;
        }

        public function setSoftwareFechaAquisicion($softwareFechaAquisicion){
            $this->softwareFechaAquisicion = $softwareFechaAquisicion;
        }

        public function getSoftwareEquiposPermitidos(){
            return $this->softwareEquiposPermitidos;
        }

        public function setSoftwareEquiposPermitidos($softwareEquiposPermitidos){
            $this->softwareEquiposPermitidos = $softwareEquiposPermitidos;
        }

        public function getSoftwareComentarios(){
            return $this->softwareComentarios;
        }

        public function setSoftwareComentarios($softwareComentarios){
            $this->softwareComentarios = $softwareComentarios;
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
            $this->softwareNumeroSerie = $entity->unscapeString($entity->getSoftwareNumeroSerie());
            $this->softwareNombre = $entity->unscapeString($entity->getSoftwareNombre());
            $this->softwareVersion = $entity->unscapeString($entity->getSoftwareVersion());
            $this->softwareFechaCaducidad = $entity->unscapeString($entity->getSoftwareFechaCaducidad());
            $this->softwareFechaAquisicion = $entity->unscapeString($entity->getSoftwareFechaAquisicion());
            $this->softwareEquiposPermitidos = $entity->unscapeString($entity->getSoftwareEquiposPermitidos());
            $this->softwareComentarios = $entity->unscapeString($entity->getSoftwareComentarios());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new SoftwareDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(SoftwareDTO $softwareDTO){
            $software = new Software();
            $software->setId($softwareDTO->getId());
            $software->setSoftwareNumeroSerie($softwareDTO->getSoftwareNumeroSerie());
            $software->setSoftwareNombre($softwareDTO->getSoftwareNombre());
            $software->setSoftwareVersion($softwareDTO->getSoftwareVersion());
            $software->setSoftwareFechaCaducidad($softwareDTO->getSoftwareFechaCaducidad());
            $software->setSoftwareFechaAquisicion($softwareDTO->getSoftwareFechaAquisicion());
            $software->setSoftwareEquiposPermitidos($softwareDTO->getSoftwareEquiposPermitidos());
            $software->setSoftwareComentarios($softwareDTO->getSoftwareComentarios());
            return $software;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->softwareNumeroSerie) && EntityValidator::validateString($this->softwareNombre) && EntityValidator::validateString($this->softwareVersion) && EntityValidator::validateNumber($this->softwareEquiposPermitidos);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Software>";
                $xml .= "<Software_Id>";
                    $xml .= $this->getId();
                $xml .= "</Software_Id>";
                if($this->getSoftwareNumeroSerie() !== null){
                    $xml .= "<softwareNumeroSerie><![CDATA[";
                        $xml .= $this->getSoftwareNumeroSerie();
                    $xml .= "]]></softwareNumeroSerie>";
                }
                if($this->getSoftwareNombre() !== null){
                    $xml .= "<softwareNombre><![CDATA[";
                        $xml .= $this->getSoftwareNombre();
                    $xml .= "]]></softwareNombre>";
                }
                if($this->getSoftwareVersion() !== null){
                    $xml .= "<softwareVersion><![CDATA[";
                        $xml .= $this->getSoftwareVersion();
                    $xml .= "]]></softwareVersion>";
                }
                if($this->getSoftwareFechaCaducidad() !== null){
                    $xml .= "<softwareFechaCaducidad><![CDATA[";
                        $xml .= $this->getSoftwareFechaCaducidad();
                    $xml .= "]]></softwareFechaCaducidad>";
                }
                if($this->getSoftwareFechaAquisicion() !== null){
                    $xml .= "<softwareFechaAquisicion><![CDATA[";
                        $xml .= $this->getSoftwareFechaAquisicion();
                    $xml .= "]]></softwareFechaAquisicion>";
                }
                if($this->getSoftwareEquiposPermitidos() !== null){
                    $xml .= "<softwareEquiposPermitidos><![CDATA[";
                        $xml .= $this->getSoftwareEquiposPermitidos();
                    $xml .= "]]></softwareEquiposPermitidos>";
                }
                if($this->getSoftwareComentarios() !== null){
                    $xml .= "<softwareComentarios><![CDATA[";
                        $xml .= $this->getSoftwareComentarios();
                    $xml .= "]]></softwareComentarios>";
                }
            $xml .= "</Software>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Software");
            foreach ($nodes as $node) {
                $dao = new SoftwareDTO();
                $data = $node->getElementsByTagName("Software_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("softwareNumeroSerie");
                if($data->length>0 && !SoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareNumeroSerie($data);
                $data = $node->getElementsByTagName("softwareNombre");
                if($data->length>0 && !SoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareNombre($data);
                $data = $node->getElementsByTagName("softwareVersion");
                if($data->length>0 && !SoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareVersion($data);
                $data = $node->getElementsByTagName("softwareFechaCaducidad");
                if($data->length>0 && !SoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareFechaCaducidad($data);
                $data = $node->getElementsByTagName("softwareFechaAquisicion");
                if($data->length>0 && !SoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareFechaAquisicion($data);
                $data = $node->getElementsByTagName("softwareEquiposPermitidos");
                if($data->length>0 && !SoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareEquiposPermitidos($data);
                $data = $node->getElementsByTagName("softwareComentarios");
                if($data->length>0 && !SoftwareDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareComentarios($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Softwares>";
                $xml .= $this->toXML();
            $xml .= "</Softwares>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Softwares>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Softwares>";
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