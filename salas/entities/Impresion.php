<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.IMPRESION_DTO;

    class Impresion {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "impresion";
        public $PRIMARY_KEY_DB_NAME = "impresion_id";

        public $IMPRESION_FECHA = "impresion_fecha";
        public static $ORDER_BY_IMPRESION_FECHA = "impresion_fecha";
        public $IMPRESION_LUGAR = "impresion_lugar";
        public static $ORDER_BY_IMPRESION_LUGAR = "impresion_lugar";
        public $IMPRESION_ESTUDIANTE = "impresion_estudiante";
        public static $ORDER_BY_IMPRESION_ESTUDIANTE = "impresion_estudiante";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $IMPRESION_LUGAR_SIZE = 50;

        # Atributos privados estandar
        private $id;
        private $impresionFecha;
        private $impresionLugar;
        private $impresionEstudiante;

        function Impresion($impresionFecha = null, $impresionLugar = null, $impresionEstudiante = null){
            $this->id = null;
            $this->impresionFecha = $this->scapeString($impresionFecha);
            $this->impresionLugar = $this->scapeString($impresionLugar);
            $this->impresionEstudiante = $this->scapeString($impresionEstudiante);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getImpresionFecha(){
            return $this->impresionFecha;
        }

        public function setImpresionFecha($impresionFecha){
            $this->impresionFecha = $impresionFecha;
        }

        public function getImpresionLugar(){
            return $this->impresionLugar;
        }

        public function setImpresionLugar($impresionLugar){
            if(strlen($impresionLugar) > $this->IMPRESION_LUGAR_SIZE){;
                $this->impresionLugar = $this->scapeString(substr($impresionLugar, 0, $this->IMPRESION_LUGAR_SIZE));
            }else{
                $this->impresionLugar = $this->scapeString($impresionLugar);
            }
        }

        public function getImpresionEstudiante(){
            return $this->impresionEstudiante;
        }

        public function setImpresionEstudiante($impresionEstudiante){
            $this->impresionEstudiante = $impresionEstudiante;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->IMPRESION_FECHA,$this->ENTITY_DB_NAME.".".$this->IMPRESION_LUGAR,$this->ENTITY_DB_NAME.".".$this->IMPRESION_ESTUDIANTE);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->IMPRESION_FECHA,$this->ENTITY_DB_NAME.".".$this->IMPRESION_LUGAR,$this->ENTITY_DB_NAME.".".$this->IMPRESION_ESTUDIANTE);
        }

        public function getDbFieldNames(){
            return array($this->IMPRESION_FECHA,$this->IMPRESION_LUGAR,$this->IMPRESION_ESTUDIANTE);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->IMPRESION_FECHA,$this->IMPRESION_LUGAR,$this->IMPRESION_ESTUDIANTE);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->IMPRESION_FECHA,$this->ENTITY_DB_NAME.".".$this->IMPRESION_LUGAR,$this->ENTITY_DB_NAME.".".$this->IMPRESION_ESTUDIANTE);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->IMPRESION_FECHA,$this->ENTITY_DB_NAME.".".$this->IMPRESION_LUGAR,$this->ENTITY_DB_NAME.".".$this->IMPRESION_ESTUDIANTE);
        }

        public function getDbListFieldNames(){
            return array($this->IMPRESION_FECHA,$this->IMPRESION_LUGAR,$this->IMPRESION_ESTUDIANTE);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->IMPRESION_FECHA,$this->IMPRESION_LUGAR,$this->IMPRESION_ESTUDIANTE);
        }

        public function getDbFieldValues(){
            return array($this->getImpresionFecha(),$this->getImpresionLugar(),$this->getImpresionEstudiante());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getImpresionFecha(),$this->getImpresionLugar(),$this->getImpresionEstudiante());
        }

        public function getDbListFieldValues(){
            return array($this->getImpresionFecha(),$this->getImpresionLugar(),$this->getImpresionEstudiante());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getImpresionFecha(),$this->getImpresionLugar(),$this->getImpresionEstudiante());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->IMPRESION_FECHA]) && !ImpresionDTO::isEmpty($rq[$this->IMPRESION_FECHA])){
                $this->impresionFecha = $this->scapeString($rq[$this->IMPRESION_FECHA]);
            }else{
                $this->impresionFecha = null;
            }
            if(isset($rq[$this->IMPRESION_LUGAR]) && !ImpresionDTO::isEmpty($rq[$this->IMPRESION_LUGAR])){
                $this->impresionLugar = $this->scapeString($rq[$this->IMPRESION_LUGAR]);
            }else{
                $this->impresionLugar = null;
            }
            if(isset($rq[$this->IMPRESION_ESTUDIANTE]) && !ImpresionDTO::isEmpty($rq[$this->IMPRESION_ESTUDIANTE])){
                $this->impresionEstudiante = $this->scapeString($rq[$this->IMPRESION_ESTUDIANTE]);
            }else{
                $this->impresionEstudiante = null;
            }
        }

        public function toDTO(){
            $impresionDTO = new ImpresionDTO();
            $impresionDTO->setId($this->getId());
            $impresionDTO->setImpresionFecha($this->unscapeString($this->getImpresionFecha()));
            $impresionDTO->setImpresionLugar($this->unscapeString($this->getImpresionLugar()));
            $impresionDTO->setImpresionEstudiante($this->unscapeString($this->getImpresionEstudiante()));
            return $impresionDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->impresionFecha) && EntityValidator::validateString($this->impresionLugar) && EntityValidator::validateId($this->impresionEstudiante);
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