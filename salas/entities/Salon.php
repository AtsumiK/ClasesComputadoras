<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.SALON_DTO;

    class Salon {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "salon";
        public $PRIMARY_KEY_DB_NAME = "salon_id";

        public $SALON_NOMBRE = "salon_nombre";
        public static $ORDER_BY_SALON_NOMBRE = "salon_nombre";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $SALON_NOMBRE_SIZE = 250;

        # Atributos privados estandar
        private $id;
        private $salonNombre;

        function Salon($salonNombre = null){
            $this->id = null;
            $this->salonNombre = $this->scapeString($salonNombre);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getSalonNombre(){
            return $this->salonNombre;
        }

        public function setSalonNombre($salonNombre){
            if(strlen($salonNombre) > $this->SALON_NOMBRE_SIZE){;
                $this->salonNombre = $this->scapeString(substr($salonNombre, 0, $this->SALON_NOMBRE_SIZE));
            }else{
                $this->salonNombre = $this->scapeString($salonNombre);
            }
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->SALON_NOMBRE);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->SALON_NOMBRE);
        }

        public function getDbFieldNames(){
            return array($this->SALON_NOMBRE);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->SALON_NOMBRE);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->SALON_NOMBRE);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->SALON_NOMBRE);
        }

        public function getDbListFieldNames(){
            return array($this->SALON_NOMBRE);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->SALON_NOMBRE);
        }

        public function getDbFieldValues(){
            return array($this->getSalonNombre());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getSalonNombre());
        }

        public function getDbListFieldValues(){
            return array($this->getSalonNombre());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getSalonNombre());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->SALON_NOMBRE]) && !SalonDTO::isEmpty($rq[$this->SALON_NOMBRE])){
                $this->salonNombre = $this->scapeString($rq[$this->SALON_NOMBRE]);
            }else{
                $this->salonNombre = null;
            }
        }

        public function toDTO(){
            $salonDTO = new SalonDTO();
            $salonDTO->setId($this->getId());
            $salonDTO->setSalonNombre($this->unscapeString($this->getSalonNombre()));
            return $salonDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->salonNombre);
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