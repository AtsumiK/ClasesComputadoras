<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.RESERVA_DTO;

    class Reserva {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "reserva";
        public $PRIMARY_KEY_DB_NAME = "reserva_id";

        public $RESERVA_CLASE = "reserva_clase";
        public static $ORDER_BY_RESERVA_CLASE = "reserva_clase";
        public $RESERVA_HORA_INICIO = "reserva_hora_inicio";
        public static $ORDER_BY_RESERVA_HORA_INICIO = "reserva_hora_inicio";
        public $RESERVA_HORA_FIN = "reserva_hora_fin";
        public static $ORDER_BY_RESERVA_HORA_FIN = "reserva_hora_fin";
        public $RESERVA_RESPONSABLE = "reserva_responsable";
        public static $ORDER_BY_RESERVA_RESPONSABLE = "reserva_responsable";
        public $RESERVA_SALON = "reserva_salon";
        public static $ORDER_BY_RESERVA_SALON = "reserva_salon";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $RESERVA_CLASE_SIZE = 250;

        # Atributos privados estandar
        private $id;
        private $reservaClase;
        private $reservaHoraInicio;
        private $reservaHoraFin;
        private $reservaResponsable;
        private $reservaSalon;

        function Reserva($reservaClase = null, $reservaHoraInicio = null, $reservaHoraFin = null, $reservaResponsable = null, $reservaSalon = null){
            $this->id = null;
            $this->reservaClase = $this->scapeString($reservaClase);
            $this->reservaHoraInicio = $this->scapeString($reservaHoraInicio);
            $this->reservaHoraFin = $this->scapeString($reservaHoraFin);
            $this->reservaResponsable = $this->scapeString($reservaResponsable);
            $this->reservaSalon = $this->scapeString($reservaSalon);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getReservaClase(){
            return $this->reservaClase;
        }

        public function setReservaClase($reservaClase){
            if(strlen($reservaClase) > $this->RESERVA_CLASE_SIZE){;
                $this->reservaClase = $this->scapeString(substr($reservaClase, 0, $this->RESERVA_CLASE_SIZE));
            }else{
                $this->reservaClase = $this->scapeString($reservaClase);
            }
        }

        public function getReservaHoraInicio(){
            return $this->reservaHoraInicio;
        }

        public function setReservaHoraInicio($reservaHoraInicio){
            $this->reservaHoraInicio = $reservaHoraInicio;
        }

        public function getReservaHoraFin(){
            return $this->reservaHoraFin;
        }

        public function setReservaHoraFin($reservaHoraFin){
            $this->reservaHoraFin = $reservaHoraFin;
        }

        public function getReservaResponsable(){
            return $this->reservaResponsable;
        }

        public function setReservaResponsable($reservaResponsable){
            $this->reservaResponsable = $reservaResponsable;
        }

        public function getReservaSalon(){
            return $this->reservaSalon;
        }

        public function setReservaSalon($reservaSalon){
            $this->reservaSalon = $reservaSalon;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->RESERVA_CLASE,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_INICIO,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_FIN,$this->ENTITY_DB_NAME.".".$this->RESERVA_RESPONSABLE,$this->ENTITY_DB_NAME.".".$this->RESERVA_SALON);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->RESERVA_CLASE,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_INICIO,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_FIN,$this->ENTITY_DB_NAME.".".$this->RESERVA_RESPONSABLE,$this->ENTITY_DB_NAME.".".$this->RESERVA_SALON);
        }

        public function getDbFieldNames(){
            return array($this->RESERVA_CLASE,$this->RESERVA_HORA_INICIO,$this->RESERVA_HORA_FIN,$this->RESERVA_RESPONSABLE,$this->RESERVA_SALON);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->RESERVA_CLASE,$this->RESERVA_HORA_INICIO,$this->RESERVA_HORA_FIN,$this->RESERVA_RESPONSABLE,$this->RESERVA_SALON);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->RESERVA_CLASE,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_INICIO,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_FIN,$this->ENTITY_DB_NAME.".".$this->RESERVA_RESPONSABLE,$this->ENTITY_DB_NAME.".".$this->RESERVA_SALON);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->RESERVA_CLASE,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_INICIO,$this->ENTITY_DB_NAME.".".$this->RESERVA_HORA_FIN,$this->ENTITY_DB_NAME.".".$this->RESERVA_RESPONSABLE,$this->ENTITY_DB_NAME.".".$this->RESERVA_SALON);
        }

        public function getDbListFieldNames(){
            return array($this->RESERVA_CLASE,$this->RESERVA_HORA_INICIO,$this->RESERVA_HORA_FIN,$this->RESERVA_RESPONSABLE,$this->RESERVA_SALON);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->RESERVA_CLASE,$this->RESERVA_HORA_INICIO,$this->RESERVA_HORA_FIN,$this->RESERVA_RESPONSABLE,$this->RESERVA_SALON);
        }

        public function getDbFieldValues(){
            return array($this->getReservaClase(),$this->getReservaHoraInicio(),$this->getReservaHoraFin(),$this->getReservaResponsable(),$this->getReservaSalon());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getReservaClase(),$this->getReservaHoraInicio(),$this->getReservaHoraFin(),$this->getReservaResponsable(),$this->getReservaSalon());
        }

        public function getDbListFieldValues(){
            return array($this->getReservaClase(),$this->getReservaHoraInicio(),$this->getReservaHoraFin(),$this->getReservaResponsable(),$this->getReservaSalon());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getReservaClase(),$this->getReservaHoraInicio(),$this->getReservaHoraFin(),$this->getReservaResponsable(),$this->getReservaSalon());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->RESERVA_CLASE]) && !ReservaDTO::isEmpty($rq[$this->RESERVA_CLASE])){
                $this->reservaClase = $this->scapeString($rq[$this->RESERVA_CLASE]);
            }else{
                $this->reservaClase = null;
            }
            if(isset($rq[$this->RESERVA_HORA_INICIO]) && !ReservaDTO::isEmpty($rq[$this->RESERVA_HORA_INICIO])){
                $this->reservaHoraInicio = $this->scapeString($rq[$this->RESERVA_HORA_INICIO]);
            }else{
                $this->reservaHoraInicio = null;
            }
            if(isset($rq[$this->RESERVA_HORA_FIN]) && !ReservaDTO::isEmpty($rq[$this->RESERVA_HORA_FIN])){
                $this->reservaHoraFin = $this->scapeString($rq[$this->RESERVA_HORA_FIN]);
            }else{
                $this->reservaHoraFin = null;
            }
            if(isset($rq[$this->RESERVA_RESPONSABLE]) && !ReservaDTO::isEmpty($rq[$this->RESERVA_RESPONSABLE])){
                $this->reservaResponsable = $this->scapeString($rq[$this->RESERVA_RESPONSABLE]);
            }else{
                $this->reservaResponsable = null;
            }
            if(isset($rq[$this->RESERVA_SALON]) && !ReservaDTO::isEmpty($rq[$this->RESERVA_SALON])){
                $this->reservaSalon = $this->scapeString($rq[$this->RESERVA_SALON]);
            }else{
                $this->reservaSalon = null;
            }
        }

        public function toDTO(){
            $reservaDTO = new ReservaDTO();
            $reservaDTO->setId($this->getId());
            $reservaDTO->setReservaClase($this->unscapeString($this->getReservaClase()));
            $reservaDTO->setReservaHoraInicio($this->unscapeString($this->getReservaHoraInicio()));
            $reservaDTO->setReservaHoraFin($this->unscapeString($this->getReservaHoraFin()));
            $reservaDTO->setReservaResponsable($this->unscapeString($this->getReservaResponsable()));
            $reservaDTO->setReservaSalon($this->unscapeString($this->getReservaSalon()));
            return $reservaDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->reservaClase) && EntityValidator::validateString($this->reservaHoraInicio) && EntityValidator::validateString($this->reservaHoraFin) && EntityValidator::validateId($this->reservaResponsable) && EntityValidator::validateId($this->reservaSalon);
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