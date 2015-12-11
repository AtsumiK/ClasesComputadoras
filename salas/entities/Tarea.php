<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.TAREA_DTO;

    class Tarea {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "tarea";
        public $PRIMARY_KEY_DB_NAME = "tarea_id";

        public $TAREA_DESCRIPCION = "tarea_descripcion";
        public static $ORDER_BY_TAREA_DESCRIPCION = "tarea_descripcion";
        public $TAREA_COMENTARIOS = "tarea_comentarios";
        public static $ORDER_BY_TAREA_COMENTARIOS = "tarea_comentarios";
        public $TAREA_FECHA_INICIO = "tarea_fecha_inicio";
        public static $ORDER_BY_TAREA_FECHA_INICIO = "tarea_fecha_inicio";
        public $TAREA_FECHA_FIN = "tarea_fecha_fin";
        public static $ORDER_BY_TAREA_FECHA_FIN = "tarea_fecha_fin";
        public $TAREA_MONITOR = "tarea_monitor";
        public static $ORDER_BY_TAREA_MONITOR = "tarea_monitor";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $TAREA_DESCRIPCION_SIZE = 5000;
        private $TAREA_COMENTARIOS_SIZE = 5000;

        # Atributos privados estandar
        private $id;
        private $tareaDescripcion;
        private $tareaComentarios;
        private $tareaFechaInicio;
        private $tareaFechaFin;
        private $tareaMonitor;

        function Tarea($tareaDescripcion = null, $tareaComentarios = null, $tareaFechaInicio = null, $tareaFechaFin = null, $tareaMonitor = null){
            $this->id = null;
            $this->tareaDescripcion = $this->scapeString($tareaDescripcion);
            $this->tareaComentarios = $this->scapeString($tareaComentarios);
            $this->tareaFechaInicio = $this->scapeString($tareaFechaInicio);
            $this->tareaFechaFin = $this->scapeString($tareaFechaFin);
            $this->tareaMonitor = $this->scapeString($tareaMonitor);
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
            if(strlen($tareaDescripcion) > $this->TAREA_DESCRIPCION_SIZE){;
                $this->tareaDescripcion = $this->scapeString(substr($tareaDescripcion, 0, $this->TAREA_DESCRIPCION_SIZE));
            }else{
                $this->tareaDescripcion = $this->scapeString($tareaDescripcion);
            }
        }

        public function getTareaComentarios(){
            return $this->tareaComentarios;
        }

        public function setTareaComentarios($tareaComentarios){
            if(strlen($tareaComentarios) > $this->TAREA_COMENTARIOS_SIZE){;
                $this->tareaComentarios = $this->scapeString(substr($tareaComentarios, 0, $this->TAREA_COMENTARIOS_SIZE));
            }else{
                $this->tareaComentarios = $this->scapeString($tareaComentarios);
            }
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


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->TAREA_DESCRIPCION,$this->ENTITY_DB_NAME.".".$this->TAREA_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_INICIO,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_FIN,$this->ENTITY_DB_NAME.".".$this->TAREA_MONITOR);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->TAREA_DESCRIPCION,$this->ENTITY_DB_NAME.".".$this->TAREA_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_INICIO,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_FIN,$this->ENTITY_DB_NAME.".".$this->TAREA_MONITOR);
        }

        public function getDbFieldNames(){
            return array($this->TAREA_DESCRIPCION,$this->TAREA_COMENTARIOS,$this->TAREA_FECHA_INICIO,$this->TAREA_FECHA_FIN,$this->TAREA_MONITOR);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->TAREA_DESCRIPCION,$this->TAREA_COMENTARIOS,$this->TAREA_FECHA_INICIO,$this->TAREA_FECHA_FIN,$this->TAREA_MONITOR);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->TAREA_DESCRIPCION,$this->ENTITY_DB_NAME.".".$this->TAREA_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_INICIO,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_FIN,$this->ENTITY_DB_NAME.".".$this->TAREA_MONITOR);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->TAREA_DESCRIPCION,$this->ENTITY_DB_NAME.".".$this->TAREA_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_INICIO,$this->ENTITY_DB_NAME.".".$this->TAREA_FECHA_FIN,$this->ENTITY_DB_NAME.".".$this->TAREA_MONITOR);
        }

        public function getDbListFieldNames(){
            return array($this->TAREA_DESCRIPCION,$this->TAREA_COMENTARIOS,$this->TAREA_FECHA_INICIO,$this->TAREA_FECHA_FIN,$this->TAREA_MONITOR);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->TAREA_DESCRIPCION,$this->TAREA_COMENTARIOS,$this->TAREA_FECHA_INICIO,$this->TAREA_FECHA_FIN,$this->TAREA_MONITOR);
        }

        public function getDbFieldValues(){
            return array($this->getTareaDescripcion(),$this->getTareaComentarios(),$this->getTareaFechaInicio(),$this->getTareaFechaFin(),$this->getTareaMonitor());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getTareaDescripcion(),$this->getTareaComentarios(),$this->getTareaFechaInicio(),$this->getTareaFechaFin(),$this->getTareaMonitor());
        }

        public function getDbListFieldValues(){
            return array($this->getTareaDescripcion(),$this->getTareaComentarios(),$this->getTareaFechaInicio(),$this->getTareaFechaFin(),$this->getTareaMonitor());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getTareaDescripcion(),$this->getTareaComentarios(),$this->getTareaFechaInicio(),$this->getTareaFechaFin(),$this->getTareaMonitor());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->TAREA_DESCRIPCION]) && !TareaDTO::isEmpty($rq[$this->TAREA_DESCRIPCION])){
                $this->tareaDescripcion = $this->scapeString($rq[$this->TAREA_DESCRIPCION]);
            }else{
                $this->tareaDescripcion = null;
            }
            if(isset($rq[$this->TAREA_COMENTARIOS]) && !TareaDTO::isEmpty($rq[$this->TAREA_COMENTARIOS])){
                $this->tareaComentarios = $this->scapeString($rq[$this->TAREA_COMENTARIOS]);
            }else{
                $this->tareaComentarios = null;
            }
            if(isset($rq[$this->TAREA_FECHA_INICIO]) && !TareaDTO::isEmpty($rq[$this->TAREA_FECHA_INICIO])){
                $this->tareaFechaInicio = $this->scapeString($rq[$this->TAREA_FECHA_INICIO]);
            }else{
                $this->tareaFechaInicio = null;
            }
            if(isset($rq[$this->TAREA_FECHA_FIN]) && !TareaDTO::isEmpty($rq[$this->TAREA_FECHA_FIN])){
                $this->tareaFechaFin = $this->scapeString($rq[$this->TAREA_FECHA_FIN]);
            }else{
                $this->tareaFechaFin = null;
            }
            if(isset($rq[$this->TAREA_MONITOR]) && !TareaDTO::isEmpty($rq[$this->TAREA_MONITOR])){
                $this->tareaMonitor = $this->scapeString($rq[$this->TAREA_MONITOR]);
            }else{
                $this->tareaMonitor = null;
            }
        }

        public function toDTO(){
            $tareaDTO = new TareaDTO();
            $tareaDTO->setId($this->getId());
            $tareaDTO->setTareaDescripcion($this->unscapeString($this->getTareaDescripcion()));
            $tareaDTO->setTareaComentarios($this->unscapeString($this->getTareaComentarios()));
            $tareaDTO->setTareaFechaInicio($this->unscapeString($this->getTareaFechaInicio()));
            $tareaDTO->setTareaFechaFin($this->unscapeString($this->getTareaFechaFin()));
            $tareaDTO->setTareaMonitor($this->unscapeString($this->getTareaMonitor()));
            return $tareaDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->tareaDescripcion) && EntityValidator::validateString($this->tareaComentarios) && EntityValidator::validateString($this->tareaFechaInicio) && EntityValidator::validateString($this->tareaFechaFin) && EntityValidator::validateId($this->tareaMonitor);
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