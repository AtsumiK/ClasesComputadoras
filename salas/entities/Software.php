<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.SOFTWARE_DTO;

    class Software {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "software";
        public $PRIMARY_KEY_DB_NAME = "software_id";

        public $SOFTWARE_NUMERO_SERIE = "software_numero_serie";
        public static $ORDER_BY_SOFTWARE_NUMERO_SERIE = "software_numero_serie";
        public $SOFTWARE_NOMBRE = "software_nombre";
        public static $ORDER_BY_SOFTWARE_NOMBRE = "software_nombre";
        public $SOFTWARE_VERSION = "software_version";
        public static $ORDER_BY_SOFTWARE_VERSION = "software_version";
        public $SOFTWARE_FECHA_CADUCIDAD = "software_fecha_caducidad";
        public static $ORDER_BY_SOFTWARE_FECHA_CADUCIDAD = "software_fecha_caducidad";
        public $SOFTWARE_FECHA_AQUISICION = "software_fecha_aquisicion";
        public static $ORDER_BY_SOFTWARE_FECHA_AQUISICION = "software_fecha_aquisicion";
        public $SOFTWARE_EQUIPOS_PERMITIDOS = "software_equipos_permitidos";
        public static $ORDER_BY_SOFTWARE_EQUIPOS_PERMITIDOS = "software_equipos_permitidos";
        public $SOFTWARE_COMENTARIOS = "software_comentarios";
        public static $ORDER_BY_SOFTWARE_COMENTARIOS = "software_comentarios";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $SOFTWARE_NUMERO_SERIE_SIZE = 50;
        private $SOFTWARE_NOMBRE_SIZE = 250;
        private $SOFTWARE_VERSION_SIZE = 20;
        private $SOFTWARE_COMENTARIOS_SIZE = 500;

        # Atributos privados estandar
        private $id;
        private $softwareNumeroSerie;
        private $softwareNombre;
        private $softwareVersion;
        private $softwareFechaCaducidad;
        private $softwareFechaAquisicion;
        private $softwareEquiposPermitidos;
        private $softwareComentarios;

        function Software($softwareNumeroSerie = null, $softwareNombre = null, $softwareVersion = null, $softwareFechaCaducidad = null, $softwareFechaAquisicion = null, $softwareEquiposPermitidos = null, $softwareComentarios = null){
            $this->id = null;
            $this->softwareNumeroSerie = $this->scapeString($softwareNumeroSerie);
            $this->softwareNombre = $this->scapeString($softwareNombre);
            $this->softwareVersion = $this->scapeString($softwareVersion);
            $this->softwareFechaCaducidad = $this->scapeString($softwareFechaCaducidad);
            $this->softwareFechaAquisicion = $this->scapeString($softwareFechaAquisicion);
            $this->softwareEquiposPermitidos = $this->scapeString($softwareEquiposPermitidos);
            $this->softwareComentarios = $this->scapeString($softwareComentarios);
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
            if(strlen($softwareNumeroSerie) > $this->SOFTWARE_NUMERO_SERIE_SIZE){;
                $this->softwareNumeroSerie = $this->scapeString(substr($softwareNumeroSerie, 0, $this->SOFTWARE_NUMERO_SERIE_SIZE));
            }else{
                $this->softwareNumeroSerie = $this->scapeString($softwareNumeroSerie);
            }
        }

        public function getSoftwareNombre(){
            return $this->softwareNombre;
        }

        public function setSoftwareNombre($softwareNombre){
            if(strlen($softwareNombre) > $this->SOFTWARE_NOMBRE_SIZE){;
                $this->softwareNombre = $this->scapeString(substr($softwareNombre, 0, $this->SOFTWARE_NOMBRE_SIZE));
            }else{
                $this->softwareNombre = $this->scapeString($softwareNombre);
            }
        }

        public function getSoftwareVersion(){
            return $this->softwareVersion;
        }

        public function setSoftwareVersion($softwareVersion){
            if(strlen($softwareVersion) > $this->SOFTWARE_VERSION_SIZE){;
                $this->softwareVersion = $this->scapeString(substr($softwareVersion, 0, $this->SOFTWARE_VERSION_SIZE));
            }else{
                $this->softwareVersion = $this->scapeString($softwareVersion);
            }
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
            if(strlen($softwareComentarios) > $this->SOFTWARE_COMENTARIOS_SIZE){;
                $this->softwareComentarios = $this->scapeString(substr($softwareComentarios, 0, $this->SOFTWARE_COMENTARIOS_SIZE));
            }else{
                $this->softwareComentarios = $this->scapeString($softwareComentarios);
            }
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->SOFTWARE_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_NOMBRE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_VERSION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_CADUCIDAD,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_AQUISICION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_COMENTARIOS);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_NOMBRE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_VERSION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_CADUCIDAD,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_AQUISICION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_COMENTARIOS);
        }

        public function getDbFieldNames(){
            return array($this->SOFTWARE_NUMERO_SERIE,$this->SOFTWARE_NOMBRE,$this->SOFTWARE_VERSION,$this->SOFTWARE_FECHA_CADUCIDAD,$this->SOFTWARE_FECHA_AQUISICION,$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->SOFTWARE_COMENTARIOS);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->SOFTWARE_NUMERO_SERIE,$this->SOFTWARE_NOMBRE,$this->SOFTWARE_VERSION,$this->SOFTWARE_FECHA_CADUCIDAD,$this->SOFTWARE_FECHA_AQUISICION,$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->SOFTWARE_COMENTARIOS);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->SOFTWARE_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_NOMBRE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_VERSION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_CADUCIDAD,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_AQUISICION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_COMENTARIOS);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_NOMBRE,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_VERSION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_CADUCIDAD,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_FECHA_AQUISICION,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_COMENTARIOS);
        }

        public function getDbListFieldNames(){
            return array($this->SOFTWARE_NUMERO_SERIE,$this->SOFTWARE_NOMBRE,$this->SOFTWARE_VERSION,$this->SOFTWARE_FECHA_CADUCIDAD,$this->SOFTWARE_FECHA_AQUISICION,$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->SOFTWARE_COMENTARIOS);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->SOFTWARE_NUMERO_SERIE,$this->SOFTWARE_NOMBRE,$this->SOFTWARE_VERSION,$this->SOFTWARE_FECHA_CADUCIDAD,$this->SOFTWARE_FECHA_AQUISICION,$this->SOFTWARE_EQUIPOS_PERMITIDOS,$this->SOFTWARE_COMENTARIOS);
        }

        public function getDbFieldValues(){
            return array($this->getSoftwareNumeroSerie(),$this->getSoftwareNombre(),$this->getSoftwareVersion(),$this->getSoftwareFechaCaducidad(),$this->getSoftwareFechaAquisicion(),$this->getSoftwareEquiposPermitidos(),$this->getSoftwareComentarios());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getSoftwareNumeroSerie(),$this->getSoftwareNombre(),$this->getSoftwareVersion(),$this->getSoftwareFechaCaducidad(),$this->getSoftwareFechaAquisicion(),$this->getSoftwareEquiposPermitidos(),$this->getSoftwareComentarios());
        }

        public function getDbListFieldValues(){
            return array($this->getSoftwareNumeroSerie(),$this->getSoftwareNombre(),$this->getSoftwareVersion(),$this->getSoftwareFechaCaducidad(),$this->getSoftwareFechaAquisicion(),$this->getSoftwareEquiposPermitidos(),$this->getSoftwareComentarios());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getSoftwareNumeroSerie(),$this->getSoftwareNombre(),$this->getSoftwareVersion(),$this->getSoftwareFechaCaducidad(),$this->getSoftwareFechaAquisicion(),$this->getSoftwareEquiposPermitidos(),$this->getSoftwareComentarios());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->SOFTWARE_NUMERO_SERIE]) && !SoftwareDTO::isEmpty($rq[$this->SOFTWARE_NUMERO_SERIE])){
                $this->softwareNumeroSerie = $this->scapeString($rq[$this->SOFTWARE_NUMERO_SERIE]);
            }else{
                $this->softwareNumeroSerie = null;
            }
            if(isset($rq[$this->SOFTWARE_NOMBRE]) && !SoftwareDTO::isEmpty($rq[$this->SOFTWARE_NOMBRE])){
                $this->softwareNombre = $this->scapeString($rq[$this->SOFTWARE_NOMBRE]);
            }else{
                $this->softwareNombre = null;
            }
            if(isset($rq[$this->SOFTWARE_VERSION]) && !SoftwareDTO::isEmpty($rq[$this->SOFTWARE_VERSION])){
                $this->softwareVersion = $this->scapeString($rq[$this->SOFTWARE_VERSION]);
            }else{
                $this->softwareVersion = null;
            }
            if(isset($rq[$this->SOFTWARE_FECHA_CADUCIDAD]) && !SoftwareDTO::isEmpty($rq[$this->SOFTWARE_FECHA_CADUCIDAD])){
                $this->softwareFechaCaducidad = $this->scapeString($rq[$this->SOFTWARE_FECHA_CADUCIDAD]);
            }else{
                $this->softwareFechaCaducidad = null;
            }
            if(isset($rq[$this->SOFTWARE_FECHA_AQUISICION]) && !SoftwareDTO::isEmpty($rq[$this->SOFTWARE_FECHA_AQUISICION])){
                $this->softwareFechaAquisicion = $this->scapeString($rq[$this->SOFTWARE_FECHA_AQUISICION]);
            }else{
                $this->softwareFechaAquisicion = null;
            }
            if(isset($rq[$this->SOFTWARE_EQUIPOS_PERMITIDOS]) && !SoftwareDTO::isEmpty($rq[$this->SOFTWARE_EQUIPOS_PERMITIDOS])){
                $this->softwareEquiposPermitidos = $this->scapeString($rq[$this->SOFTWARE_EQUIPOS_PERMITIDOS]);
            }else{
                $this->softwareEquiposPermitidos = null;
            }
            if(isset($rq[$this->SOFTWARE_COMENTARIOS]) && !SoftwareDTO::isEmpty($rq[$this->SOFTWARE_COMENTARIOS])){
                $this->softwareComentarios = $this->scapeString($rq[$this->SOFTWARE_COMENTARIOS]);
            }else{
                $this->softwareComentarios = null;
            }
        }

        public function toDTO(){
            $softwareDTO = new SoftwareDTO();
            $softwareDTO->setId($this->getId());
            $softwareDTO->setSoftwareNumeroSerie($this->unscapeString($this->getSoftwareNumeroSerie()));
            $softwareDTO->setSoftwareNombre($this->unscapeString($this->getSoftwareNombre()));
            $softwareDTO->setSoftwareVersion($this->unscapeString($this->getSoftwareVersion()));
            $softwareDTO->setSoftwareFechaCaducidad($this->unscapeString($this->getSoftwareFechaCaducidad()));
            $softwareDTO->setSoftwareFechaAquisicion($this->unscapeString($this->getSoftwareFechaAquisicion()));
            $softwareDTO->setSoftwareEquiposPermitidos($this->unscapeString($this->getSoftwareEquiposPermitidos()));
            $softwareDTO->setSoftwareComentarios($this->unscapeString($this->getSoftwareComentarios()));
            return $softwareDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->softwareNumeroSerie) && EntityValidator::validateString($this->softwareNombre) && EntityValidator::validateString($this->softwareVersion) && EntityValidator::validateNumber($this->softwareEquiposPermitidos);
        }
        /**
         * Esta función trata de prevenir el SQL Injection
         * @param $str
        */
        private function scapeString($str){
            if(!empty($str)){
                return str_replace(array("'","’"),"''",$str);
            }else{
                return $str;
            }
        }
        public function unscapeString($str){
            if(!empty($str)){
                return str_replace(array("''"),"'",$str);
            }else{
                return $str;
            }
        }
    }
?>