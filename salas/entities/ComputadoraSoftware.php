<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.COMPUTADORA_SOFTWARE_DTO;

    class ComputadoraSoftware {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "computadora_software";
        public $PRIMARY_KEY_DB_NAME = "computadora_software_id";

        public $NUMERO_SERIE_PROGRAMA = "numero_serie_programa";
        public static $ORDER_BY_NUMERO_SERIE_PROGRAMA = "numero_serie_programa";
        public $COMP_SOFT_FECHA_INSTALACION = "comp_soft_fecha_instalacion";
        public static $ORDER_BY_COMP_SOFT_FECHA_INSTALACION = "comp_soft_fecha_instalacion";
        public $COMPUTADORA = "computadora";
        public static $ORDER_BY_COMPUTADORA = "computadora";
        public $SOFTWARE = "software";
        public static $ORDER_BY_SOFTWARE = "software";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $NUMERO_SERIE_PROGRAMA_SIZE = 25;
        private $COMP_SOFT_FECHA_INSTALACION_SIZE = 60;

        # Atributos privados estandar
        private $id;
        private $numeroSeriePrograma;
        private $compSoftFechaInstalacion;
        private $computadora;
        private $software;

        function ComputadoraSoftware($numeroSeriePrograma = null, $compSoftFechaInstalacion = null, $computadora = null, $software = null){
            $this->id = null;
            $this->numeroSeriePrograma = $this->scapeString($numeroSeriePrograma);
            $this->compSoftFechaInstalacion = $this->scapeString($compSoftFechaInstalacion);
            $this->computadora = $this->scapeString($computadora);
            $this->software = $this->scapeString($software);
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
            if(strlen($numeroSeriePrograma) > $this->NUMERO_SERIE_PROGRAMA_SIZE){;
                $this->numeroSeriePrograma = $this->scapeString(substr($numeroSeriePrograma, 0, $this->NUMERO_SERIE_PROGRAMA_SIZE));
            }else{
                $this->numeroSeriePrograma = $this->scapeString($numeroSeriePrograma);
            }
        }

        public function getCompSoftFechaInstalacion(){
            return $this->compSoftFechaInstalacion;
        }

        public function setCompSoftFechaInstalacion($compSoftFechaInstalacion){
            if(strlen($compSoftFechaInstalacion) > $this->COMP_SOFT_FECHA_INSTALACION_SIZE){;
                $this->compSoftFechaInstalacion = $this->scapeString(substr($compSoftFechaInstalacion, 0, $this->COMP_SOFT_FECHA_INSTALACION_SIZE));
            }else{
                $this->compSoftFechaInstalacion = $this->scapeString($compSoftFechaInstalacion);
            }
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


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->SOFTWARE);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->SOFTWARE);
        }

        public function getDbFieldNames(){
            return array($this->NUMERO_SERIE_PROGRAMA,$this->COMP_SOFT_FECHA_INSTALACION,$this->COMPUTADORA,$this->SOFTWARE);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->NUMERO_SERIE_PROGRAMA,$this->COMP_SOFT_FECHA_INSTALACION,$this->COMPUTADORA,$this->SOFTWARE);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->SOFTWARE);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->SOFTWARE);
        }

        public function getDbListFieldNames(){
            return array($this->NUMERO_SERIE_PROGRAMA,$this->COMP_SOFT_FECHA_INSTALACION,$this->COMPUTADORA,$this->SOFTWARE);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->NUMERO_SERIE_PROGRAMA,$this->COMP_SOFT_FECHA_INSTALACION,$this->COMPUTADORA,$this->SOFTWARE);
        }

        public function getDbFieldValues(){
            return array($this->getNumeroSeriePrograma(),$this->getCompSoftFechaInstalacion(),$this->getComputadora(),$this->getSoftware());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getNumeroSeriePrograma(),$this->getCompSoftFechaInstalacion(),$this->getComputadora(),$this->getSoftware());
        }

        public function getDbListFieldValues(){
            return array($this->getNumeroSeriePrograma(),$this->getCompSoftFechaInstalacion(),$this->getComputadora(),$this->getSoftware());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getNumeroSeriePrograma(),$this->getCompSoftFechaInstalacion(),$this->getComputadora(),$this->getSoftware());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->NUMERO_SERIE_PROGRAMA]) && !ComputadoraSoftwareDTO::isEmpty($rq[$this->NUMERO_SERIE_PROGRAMA])){
                $this->numeroSeriePrograma = $this->scapeString($rq[$this->NUMERO_SERIE_PROGRAMA]);
            }else{
                $this->numeroSeriePrograma = null;
            }
            if(isset($rq[$this->COMP_SOFT_FECHA_INSTALACION]) && !ComputadoraSoftwareDTO::isEmpty($rq[$this->COMP_SOFT_FECHA_INSTALACION])){
                $this->compSoftFechaInstalacion = $this->scapeString($rq[$this->COMP_SOFT_FECHA_INSTALACION]);
            }else{
                $this->compSoftFechaInstalacion = null;
            }
            if(isset($rq[$this->COMPUTADORA]) && !ComputadoraSoftwareDTO::isEmpty($rq[$this->COMPUTADORA])){
                $this->computadora = $this->scapeString($rq[$this->COMPUTADORA]);
            }else{
                $this->computadora = null;
            }
            if(isset($rq[$this->SOFTWARE]) && !ComputadoraSoftwareDTO::isEmpty($rq[$this->SOFTWARE])){
                $this->software = $this->scapeString($rq[$this->SOFTWARE]);
            }else{
                $this->software = null;
            }
        }

        public function toDTO(){
            $computadoraSoftwareDTO = new ComputadoraSoftwareDTO();
            $computadoraSoftwareDTO->setId($this->getId());
            $computadoraSoftwareDTO->setNumeroSeriePrograma($this->unscapeString($this->getNumeroSeriePrograma()));
            $computadoraSoftwareDTO->setCompSoftFechaInstalacion($this->unscapeString($this->getCompSoftFechaInstalacion()));
            $computadoraSoftwareDTO->setComputadora($this->unscapeString($this->getComputadora()));
            $computadoraSoftwareDTO->setSoftware($this->unscapeString($this->getSoftware()));
            return $computadoraSoftwareDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->numeroSeriePrograma) && EntityValidator::validateId($this->computadora) && EntityValidator::validateId($this->software);
        }
        /**
         * Esta función trata de prevenir el SQL Injection
         * @param $str
        */
        private function scapeString($str){
            if(!empty($str)){
                return addslashes(stripslashes($str));
            }else{
                return $str;
            }
        }
        public function unscapeString($str){
            if(!empty($str)){
                return stripslashes($str);
            }else{
                return $str;
            }
        }
    }
?>