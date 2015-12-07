<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.COMPUTADORA_DTO;

    class Computadora {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "computadora";
        public $PRIMARY_KEY_DB_NAME = "computadora_id";

        public $COMPUTADORA_NOMBRE = "computadora_nombre";
        public static $ORDER_BY_COMPUTADORA_NOMBRE = "computadora_nombre";
        public $COMPUTADORA_RAM = "computadora_ram";
        public static $ORDER_BY_COMPUTADORA_RAM = "computadora_ram";
        public $COMPUTADORA_PROCESADOR = "computadora_procesador";
        public static $ORDER_BY_COMPUTADORA_PROCESADOR = "computadora_procesador";
        public $COMPUTADORA_DISCO_DURO = "computadora_disco_duro";
        public static $ORDER_BY_COMPUTADORA_DISCO_DURO = "computadora_disco_duro";
        public $COMPUTADORA_DIR_IP = "computadora_dir_ip";
        public static $ORDER_BY_COMPUTADORA_DIR_IP = "computadora_dir_ip";
        public $COMPUTADORA_DIR_MAC = "computadora_dir_mac";
        public static $ORDER_BY_COMPUTADORA_DIR_MAC = "computadora_dir_mac";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $COMPUTADORA_NOMBRE_SIZE = 10;
        private $COMPUTADORA_RAM_SIZE = 60;
        private $COMPUTADORA_PROCESADOR_SIZE = 60;
        private $COMPUTADORA_DISCO_DURO_SIZE = 60;
        private $COMPUTADORA_DIR_IP_SIZE = 16;
        private $COMPUTADORA_DIR_MAC_SIZE = 20;

        # Atributos privados estandar
        private $id;
        private $computadoraNombre;
        private $computadoraRam;
        private $computadoraProcesador;
        private $computadoraDiscoDuro;
        private $computadoraDirIp;
        private $computadoraDirMac;
        private $computaoraObjetosInventario;

        function Computadora($computadoraNombre = null, $computadoraRam = null, $computadoraProcesador = null, $computadoraDiscoDuro = null, $computadoraDirIp = null, $computadoraDirMac = null, array $computaoraObjetosInventario = null){
            $this->id = null;
            $this->computadoraNombre = $this->scapeString($computadoraNombre);
            $this->computadoraRam = $this->scapeString($computadoraRam);
            $this->computadoraProcesador = $this->scapeString($computadoraProcesador);
            $this->computadoraDiscoDuro = $this->scapeString($computadoraDiscoDuro);
            $this->computadoraDirIp = $this->scapeString($computadoraDirIp);
            $this->computadoraDirMac = $this->scapeString($computadoraDirMac);
            $this->computaoraObjetosInventario = $this->scapeString($computaoraObjetosInventario);
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
            if(strlen($computadoraNombre) > $this->COMPUTADORA_NOMBRE_SIZE){;
                $this->computadoraNombre = $this->scapeString(substr($computadoraNombre, 0, $this->COMPUTADORA_NOMBRE_SIZE));
            }else{
                $this->computadoraNombre = $this->scapeString($computadoraNombre);
            }
        }

        public function getComputadoraRam(){
            return $this->computadoraRam;
        }

        public function setComputadoraRam($computadoraRam){
            if(strlen($computadoraRam) > $this->COMPUTADORA_RAM_SIZE){;
                $this->computadoraRam = $this->scapeString(substr($computadoraRam, 0, $this->COMPUTADORA_RAM_SIZE));
            }else{
                $this->computadoraRam = $this->scapeString($computadoraRam);
            }
        }

        public function getComputadoraProcesador(){
            return $this->computadoraProcesador;
        }

        public function setComputadoraProcesador($computadoraProcesador){
            if(strlen($computadoraProcesador) > $this->COMPUTADORA_PROCESADOR_SIZE){;
                $this->computadoraProcesador = $this->scapeString(substr($computadoraProcesador, 0, $this->COMPUTADORA_PROCESADOR_SIZE));
            }else{
                $this->computadoraProcesador = $this->scapeString($computadoraProcesador);
            }
        }

        public function getComputadoraDiscoDuro(){
            return $this->computadoraDiscoDuro;
        }

        public function setComputadoraDiscoDuro($computadoraDiscoDuro){
            if(strlen($computadoraDiscoDuro) > $this->COMPUTADORA_DISCO_DURO_SIZE){;
                $this->computadoraDiscoDuro = $this->scapeString(substr($computadoraDiscoDuro, 0, $this->COMPUTADORA_DISCO_DURO_SIZE));
            }else{
                $this->computadoraDiscoDuro = $this->scapeString($computadoraDiscoDuro);
            }
        }

        public function getComputadoraDirIp(){
            return $this->computadoraDirIp;
        }

        public function setComputadoraDirIp($computadoraDirIp){
            if(strlen($computadoraDirIp) > $this->COMPUTADORA_DIR_IP_SIZE){;
                $this->computadoraDirIp = $this->scapeString(substr($computadoraDirIp, 0, $this->COMPUTADORA_DIR_IP_SIZE));
            }else{
                $this->computadoraDirIp = $this->scapeString($computadoraDirIp);
            }
        }

        public function getComputadoraDirMac(){
            return $this->computadoraDirMac;
        }

        public function setComputadoraDirMac($computadoraDirMac){
            if(strlen($computadoraDirMac) > $this->COMPUTADORA_DIR_MAC_SIZE){;
                $this->computadoraDirMac = $this->scapeString(substr($computadoraDirMac, 0, $this->COMPUTADORA_DIR_MAC_SIZE));
            }else{
                $this->computadoraDirMac = $this->scapeString($computadoraDirMac);
            }
        }

        public function getComputaoraObjetosInventario(){
            return $this->computaoraObjetosInventario;
        }

        public function setComputaoraObjetosInventario(array $computaoraObjetosInventario){
            $this->computaoraObjetosInventario = $computaoraObjetosInventario;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->COMPUTADORA_NOMBRE,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_RAM,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_PROCESADOR,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DISCO_DURO,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_IP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_MAC);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_NOMBRE,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_RAM,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_PROCESADOR,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DISCO_DURO,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_IP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_MAC);
        }

        public function getDbFieldNames(){
            return array($this->COMPUTADORA_NOMBRE,$this->COMPUTADORA_RAM,$this->COMPUTADORA_PROCESADOR,$this->COMPUTADORA_DISCO_DURO,$this->COMPUTADORA_DIR_IP,$this->COMPUTADORA_DIR_MAC);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->COMPUTADORA_NOMBRE,$this->COMPUTADORA_RAM,$this->COMPUTADORA_PROCESADOR,$this->COMPUTADORA_DISCO_DURO,$this->COMPUTADORA_DIR_IP,$this->COMPUTADORA_DIR_MAC);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->COMPUTADORA_NOMBRE,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_RAM,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_PROCESADOR,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DISCO_DURO,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_IP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_MAC);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_NOMBRE,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_RAM,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_PROCESADOR,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DISCO_DURO,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_IP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_DIR_MAC);
        }

        public function getDbListFieldNames(){
            return array($this->COMPUTADORA_NOMBRE,$this->COMPUTADORA_RAM,$this->COMPUTADORA_PROCESADOR,$this->COMPUTADORA_DISCO_DURO,$this->COMPUTADORA_DIR_IP,$this->COMPUTADORA_DIR_MAC);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->COMPUTADORA_NOMBRE,$this->COMPUTADORA_RAM,$this->COMPUTADORA_PROCESADOR,$this->COMPUTADORA_DISCO_DURO,$this->COMPUTADORA_DIR_IP,$this->COMPUTADORA_DIR_MAC);
        }

        public function getDbFieldValues(){
            return array($this->getComputadoraNombre(),$this->getComputadoraRam(),$this->getComputadoraProcesador(),$this->getComputadoraDiscoDuro(),$this->getComputadoraDirIp(),$this->getComputadoraDirMac());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getComputadoraNombre(),$this->getComputadoraRam(),$this->getComputadoraProcesador(),$this->getComputadoraDiscoDuro(),$this->getComputadoraDirIp(),$this->getComputadoraDirMac());
        }

        public function getDbListFieldValues(){
            return array($this->getComputadoraNombre(),$this->getComputadoraRam(),$this->getComputadoraProcesador(),$this->getComputadoraDiscoDuro(),$this->getComputadoraDirIp(),$this->getComputadoraDirMac());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getComputadoraNombre(),$this->getComputadoraRam(),$this->getComputadoraProcesador(),$this->getComputadoraDiscoDuro(),$this->getComputadoraDirIp(),$this->getComputadoraDirMac());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->COMPUTADORA_NOMBRE]) && !ComputadoraDTO::isEmpty($rq[$this->COMPUTADORA_NOMBRE])){
                $this->computadoraNombre = $this->scapeString($rq[$this->COMPUTADORA_NOMBRE]);
            }else{
                $this->computadoraNombre = null;
            }
            if(isset($rq[$this->COMPUTADORA_RAM]) && !ComputadoraDTO::isEmpty($rq[$this->COMPUTADORA_RAM])){
                $this->computadoraRam = $this->scapeString($rq[$this->COMPUTADORA_RAM]);
            }else{
                $this->computadoraRam = null;
            }
            if(isset($rq[$this->COMPUTADORA_PROCESADOR]) && !ComputadoraDTO::isEmpty($rq[$this->COMPUTADORA_PROCESADOR])){
                $this->computadoraProcesador = $this->scapeString($rq[$this->COMPUTADORA_PROCESADOR]);
            }else{
                $this->computadoraProcesador = null;
            }
            if(isset($rq[$this->COMPUTADORA_DISCO_DURO]) && !ComputadoraDTO::isEmpty($rq[$this->COMPUTADORA_DISCO_DURO])){
                $this->computadoraDiscoDuro = $this->scapeString($rq[$this->COMPUTADORA_DISCO_DURO]);
            }else{
                $this->computadoraDiscoDuro = null;
            }
            if(isset($rq[$this->COMPUTADORA_DIR_IP]) && !ComputadoraDTO::isEmpty($rq[$this->COMPUTADORA_DIR_IP])){
                $this->computadoraDirIp = $this->scapeString($rq[$this->COMPUTADORA_DIR_IP]);
            }else{
                $this->computadoraDirIp = null;
            }
            if(isset($rq[$this->COMPUTADORA_DIR_MAC]) && !ComputadoraDTO::isEmpty($rq[$this->COMPUTADORA_DIR_MAC])){
                $this->computadoraDirMac = $this->scapeString($rq[$this->COMPUTADORA_DIR_MAC]);
            }else{
                $this->computadoraDirMac = null;
            }
            $this->computaoraObjetosInventario = array();
        }

        public function toDTO(){
            $computadoraDTO = new ComputadoraDTO();
            $computadoraDTO->setId($this->getId());
            $computadoraDTO->setComputadoraNombre($this->unscapeString($this->getComputadoraNombre()));
            $computadoraDTO->setComputadoraRam($this->unscapeString($this->getComputadoraRam()));
            $computadoraDTO->setComputadoraProcesador($this->unscapeString($this->getComputadoraProcesador()));
            $computadoraDTO->setComputadoraDiscoDuro($this->unscapeString($this->getComputadoraDiscoDuro()));
            $computadoraDTO->setComputadoraDirIp($this->unscapeString($this->getComputadoraDirIp()));
            $computadoraDTO->setComputadoraDirMac($this->unscapeString($this->getComputadoraDirMac()));
            $computadoraDTO->setComputaoraObjetosInventario(array());
            return $computadoraDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->computadoraNombre) && EntityValidator::validateString($this->computadoraRam) && EntityValidator::validateString($this->computadoraProcesador) && EntityValidator::validateString($this->computadoraDiscoDuro);
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