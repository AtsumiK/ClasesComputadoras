<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.MONITOR_SALON_DTO;

    class MonitorSalon {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "monitor_salon";
        public $PRIMARY_KEY_DB_NAME = "monitor_salon_id";

        public $MONITOR_SALON_ENTRADA = "monitor_salon_entrada";
        public static $ORDER_BY_MONITOR_SALON_ENTRADA = "monitor_salon_entrada";
        public $MONITOR_SALON_SALIDA = "monitor_salon_salida";
        public static $ORDER_BY_MONITOR_SALON_SALIDA = "monitor_salon_salida";
        public $MONITOR_SALON_COMENTARIOS = "monitor_salon_comentarios";
        public static $ORDER_BY_MONITOR_SALON_COMENTARIOS = "monitor_salon_comentarios";
        public $MONITOR = "monitor";
        public static $ORDER_BY_MONITOR = "monitor";
        public $SALON = "salon";
        public static $ORDER_BY_SALON = "salon";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $MONITOR_SALON_COMENTARIOS_SIZE = 5000;

        # Atributos privados estandar
        private $id;
        private $monitorSalonEntrada;
        private $monitorSalonSalida;
        private $monitorSalonComentarios;
        private $monitor;
        private $salon;

        function MonitorSalon($monitorSalonEntrada = null, $monitorSalonSalida = null, $monitorSalonComentarios = null, $monitor = null, $salon = null){
            $this->id = null;
            $this->monitorSalonEntrada = $this->scapeString($monitorSalonEntrada);
            $this->monitorSalonSalida = $this->scapeString($monitorSalonSalida);
            $this->monitorSalonComentarios = $this->scapeString($monitorSalonComentarios);
            $this->monitor = $this->scapeString($monitor);
            $this->salon = $this->scapeString($salon);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getMonitorSalonEntrada(){
            return $this->monitorSalonEntrada;
        }

        public function setMonitorSalonEntrada($monitorSalonEntrada){
            $this->monitorSalonEntrada = $monitorSalonEntrada;
        }

        public function getMonitorSalonSalida(){
            return $this->monitorSalonSalida;
        }

        public function setMonitorSalonSalida($monitorSalonSalida){
            $this->monitorSalonSalida = $monitorSalonSalida;
        }

        public function getMonitorSalonComentarios(){
            return $this->monitorSalonComentarios;
        }

        public function setMonitorSalonComentarios($monitorSalonComentarios){
            if(strlen($monitorSalonComentarios) > $this->MONITOR_SALON_COMENTARIOS_SIZE){;
                $this->monitorSalonComentarios = $this->scapeString(substr($monitorSalonComentarios, 0, $this->MONITOR_SALON_COMENTARIOS_SIZE));
            }else{
                $this->monitorSalonComentarios = $this->scapeString($monitorSalonComentarios);
            }
        }

        public function getMonitor(){
            return $this->monitor;
        }

        public function setMonitor($monitor){
            $this->monitor = $monitor;
        }

        public function getSalon(){
            return $this->salon;
        }

        public function setSalon($salon){
            $this->salon = $salon;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_ENTRADA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_SALIDA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->MONITOR,$this->ENTITY_DB_NAME.".".$this->SALON);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_ENTRADA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_SALIDA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->MONITOR,$this->ENTITY_DB_NAME.".".$this->SALON);
        }

        public function getDbFieldNames(){
            return array($this->MONITOR_SALON_ENTRADA,$this->MONITOR_SALON_SALIDA,$this->MONITOR_SALON_COMENTARIOS,$this->MONITOR,$this->SALON);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->MONITOR_SALON_ENTRADA,$this->MONITOR_SALON_SALIDA,$this->MONITOR_SALON_COMENTARIOS,$this->MONITOR,$this->SALON);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_ENTRADA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_SALIDA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->MONITOR,$this->ENTITY_DB_NAME.".".$this->SALON);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_ENTRADA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_SALIDA,$this->ENTITY_DB_NAME.".".$this->MONITOR_SALON_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->MONITOR,$this->ENTITY_DB_NAME.".".$this->SALON);
        }

        public function getDbListFieldNames(){
            return array($this->MONITOR_SALON_ENTRADA,$this->MONITOR_SALON_SALIDA,$this->MONITOR_SALON_COMENTARIOS,$this->MONITOR,$this->SALON);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->MONITOR_SALON_ENTRADA,$this->MONITOR_SALON_SALIDA,$this->MONITOR_SALON_COMENTARIOS,$this->MONITOR,$this->SALON);
        }

        public function getDbFieldValues(){
            return array($this->getMonitorSalonEntrada(),$this->getMonitorSalonSalida(),$this->getMonitorSalonComentarios(),$this->getMonitor(),$this->getSalon());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getMonitorSalonEntrada(),$this->getMonitorSalonSalida(),$this->getMonitorSalonComentarios(),$this->getMonitor(),$this->getSalon());
        }

        public function getDbListFieldValues(){
            return array($this->getMonitorSalonEntrada(),$this->getMonitorSalonSalida(),$this->getMonitorSalonComentarios(),$this->getMonitor(),$this->getSalon());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getMonitorSalonEntrada(),$this->getMonitorSalonSalida(),$this->getMonitorSalonComentarios(),$this->getMonitor(),$this->getSalon());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->MONITOR_SALON_ENTRADA]) && !MonitorSalonDTO::isEmpty($rq[$this->MONITOR_SALON_ENTRADA])){
                $this->monitorSalonEntrada = $this->scapeString($rq[$this->MONITOR_SALON_ENTRADA]);
            }else{
                $this->monitorSalonEntrada = null;
            }
            if(isset($rq[$this->MONITOR_SALON_SALIDA]) && !MonitorSalonDTO::isEmpty($rq[$this->MONITOR_SALON_SALIDA])){
                $this->monitorSalonSalida = $this->scapeString($rq[$this->MONITOR_SALON_SALIDA]);
            }else{
                $this->monitorSalonSalida = null;
            }
            if(isset($rq[$this->MONITOR_SALON_COMENTARIOS]) && !MonitorSalonDTO::isEmpty($rq[$this->MONITOR_SALON_COMENTARIOS])){
                $this->monitorSalonComentarios = $this->scapeString($rq[$this->MONITOR_SALON_COMENTARIOS]);
            }else{
                $this->monitorSalonComentarios = null;
            }
            if(isset($rq[$this->MONITOR]) && !MonitorSalonDTO::isEmpty($rq[$this->MONITOR])){
                $this->monitor = $this->scapeString($rq[$this->MONITOR]);
            }else{
                $this->monitor = null;
            }
            if(isset($rq[$this->SALON]) && !MonitorSalonDTO::isEmpty($rq[$this->SALON])){
                $this->salon = $this->scapeString($rq[$this->SALON]);
            }else{
                $this->salon = null;
            }
        }

        public function toDTO(){
            $monitorSalonDTO = new MonitorSalonDTO();
            $monitorSalonDTO->setId($this->getId());
            $monitorSalonDTO->setMonitorSalonEntrada($this->unscapeString($this->getMonitorSalonEntrada()));
            $monitorSalonDTO->setMonitorSalonSalida($this->unscapeString($this->getMonitorSalonSalida()));
            $monitorSalonDTO->setMonitorSalonComentarios($this->unscapeString($this->getMonitorSalonComentarios()));
            $monitorSalonDTO->setMonitor($this->unscapeString($this->getMonitor()));
            $monitorSalonDTO->setSalon($this->unscapeString($this->getSalon()));
            return $monitorSalonDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->monitorSalonEntrada) && EntityValidator::validateString($this->monitorSalonSalida) && EntityValidator::validateId($this->monitor) && EntityValidator::validateId($this->salon);
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