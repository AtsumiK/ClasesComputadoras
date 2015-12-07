<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.MONITOR_DTO;

    class Monitor {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "monitor";
        public $PRIMARY_KEY_DB_NAME = "monitor_id";

        public $MONITOR_TIPO = "monitor_tipo";
        public static $ORDER_BY_MONITOR_TIPO = "monitor_tipo";
        public $MONITOR_HORARIO = "monitor_horario";
        public static $ORDER_BY_MONITOR_HORARIO = "monitor_horario";
        public $MONITOR_ESTUDIANTE = "monitor_estudiante";
        public static $ORDER_BY_MONITOR_ESTUDIANTE = "monitor_estudiante";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $MONITOR_TIPO_SIZE = 5;
        private $MONITOR_HORARIO_SIZE = 100;

        # Atributos privados estandar
        private $id;
        private $monitorTipo;
        private $monitorHorario;
        private $monitorEstudiante;

        function Monitor($monitorTipo = null, $monitorHorario = null, $monitorEstudiante = null){
            $this->id = null;
            $this->monitorTipo = $this->scapeString($monitorTipo);
            $this->monitorHorario = $this->scapeString($monitorHorario);
            $this->monitorEstudiante = $this->scapeString($monitorEstudiante);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getMonitorTipo(){
            return $this->monitorTipo;
        }

        public function setMonitorTipo($monitorTipo){
            if(strlen($monitorTipo) > $this->MONITOR_TIPO_SIZE){;
                $this->monitorTipo = $this->scapeString(substr($monitorTipo, 0, $this->MONITOR_TIPO_SIZE));
            }else{
                $this->monitorTipo = $this->scapeString($monitorTipo);
            }
        }

        public function getMonitorHorario(){
            return $this->monitorHorario;
        }

        public function setMonitorHorario($monitorHorario){
            if(strlen($monitorHorario) > $this->MONITOR_HORARIO_SIZE){;
                $this->monitorHorario = $this->scapeString(substr($monitorHorario, 0, $this->MONITOR_HORARIO_SIZE));
            }else{
                $this->monitorHorario = $this->scapeString($monitorHorario);
            }
        }

        public function getMonitorEstudiante(){
            return $this->monitorEstudiante;
        }

        public function setMonitorEstudiante($monitorEstudiante){
            $this->monitorEstudiante = $monitorEstudiante;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->MONITOR_TIPO,$this->ENTITY_DB_NAME.".".$this->MONITOR_HORARIO,$this->ENTITY_DB_NAME.".".$this->MONITOR_ESTUDIANTE);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->MONITOR_TIPO,$this->ENTITY_DB_NAME.".".$this->MONITOR_HORARIO,$this->ENTITY_DB_NAME.".".$this->MONITOR_ESTUDIANTE);
        }

        public function getDbFieldNames(){
            return array($this->MONITOR_TIPO,$this->MONITOR_HORARIO,$this->MONITOR_ESTUDIANTE);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->MONITOR_TIPO,$this->MONITOR_HORARIO,$this->MONITOR_ESTUDIANTE);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->MONITOR_TIPO,$this->ENTITY_DB_NAME.".".$this->MONITOR_HORARIO,$this->ENTITY_DB_NAME.".".$this->MONITOR_ESTUDIANTE);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->MONITOR_TIPO,$this->ENTITY_DB_NAME.".".$this->MONITOR_HORARIO,$this->ENTITY_DB_NAME.".".$this->MONITOR_ESTUDIANTE);
        }

        public function getDbListFieldNames(){
            return array($this->MONITOR_TIPO,$this->MONITOR_HORARIO,$this->MONITOR_ESTUDIANTE);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->MONITOR_TIPO,$this->MONITOR_HORARIO,$this->MONITOR_ESTUDIANTE);
        }

        public function getDbFieldValues(){
            return array($this->getMonitorTipo(),$this->getMonitorHorario(),$this->getMonitorEstudiante());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getMonitorTipo(),$this->getMonitorHorario(),$this->getMonitorEstudiante());
        }

        public function getDbListFieldValues(){
            return array($this->getMonitorTipo(),$this->getMonitorHorario(),$this->getMonitorEstudiante());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getMonitorTipo(),$this->getMonitorHorario(),$this->getMonitorEstudiante());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->MONITOR_TIPO]) && !MonitorDTO::isEmpty($rq[$this->MONITOR_TIPO])){
                $this->monitorTipo = $this->scapeString($rq[$this->MONITOR_TIPO]);
            }else{
                $this->monitorTipo = null;
            }
            if(isset($rq[$this->MONITOR_HORARIO]) && !MonitorDTO::isEmpty($rq[$this->MONITOR_HORARIO])){
                $this->monitorHorario = $this->scapeString($rq[$this->MONITOR_HORARIO]);
            }else{
                $this->monitorHorario = null;
            }
            if(isset($rq[$this->MONITOR_ESTUDIANTE]) && !MonitorDTO::isEmpty($rq[$this->MONITOR_ESTUDIANTE])){
                $this->monitorEstudiante = $this->scapeString($rq[$this->MONITOR_ESTUDIANTE]);
            }else{
                $this->monitorEstudiante = null;
            }
        }

        public function toDTO(){
            $monitorDTO = new MonitorDTO();
            $monitorDTO->setId($this->getId());
            $monitorDTO->setMonitorTipo($this->unscapeString($this->getMonitorTipo()));
            $monitorDTO->setMonitorHorario($this->unscapeString($this->getMonitorHorario()));
            $monitorDTO->setMonitorEstudiante($this->unscapeString($this->getMonitorEstudiante()));
            return $monitorDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->monitorTipo) && EntityValidator::validateString($this->monitorHorario) && EntityValidator::validateId($this->monitorEstudiante);
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