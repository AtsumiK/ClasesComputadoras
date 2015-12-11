<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.OBJETO_EN_INVENTARIO_DTO;

    class ObjetoEnInventario {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "objeto_en_inventario";
        public $PRIMARY_KEY_DB_NAME = "objeto_en_inventario_id";

        public $INVENTARIO_ELEMENTO = "inventario_elemento";
        public static $ORDER_BY_INVENTARIO_ELEMENTO = "inventario_elemento";
        public $INVENTARIO_NUMERO_SERIE = "inventario_numero_serie";
        public static $ORDER_BY_INVENTARIO_NUMERO_SERIE = "inventario_numero_serie";
        public $INVENTARIO_SALON = "inventario_salon";
        public static $ORDER_BY_INVENTARIO_SALON = "inventario_salon";
        public $COMPUTADORA = "computadora_id";
        public static $ORDER_BY_COMPUTADORA = "computadora_id";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $INVENTARIO_ELEMENTO_SIZE = 250;
        private $INVENTARIO_NUMERO_SERIE_SIZE = 50;

        # Atributos privados estandar
        private $id;
        private $inventarioElemento;
        private $inventarioNumeroSerie;
        private $inventarioSalon;
        private $computadora;

        function ObjetoEnInventario($inventarioElemento = null, $inventarioNumeroSerie = null, $inventarioSalon = null, $computadora = null){
            $this->id = null;
            $this->inventarioElemento = $this->scapeString($inventarioElemento);
            $this->inventarioNumeroSerie = $this->scapeString($inventarioNumeroSerie);
            $this->inventarioSalon = $this->scapeString($inventarioSalon);
            $this->computadora = $this->scapeString($computadora);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getInventarioElemento(){
            return $this->inventarioElemento;
        }

        public function setInventarioElemento($inventarioElemento){
            if(strlen($inventarioElemento) > $this->INVENTARIO_ELEMENTO_SIZE){;
                $this->inventarioElemento = $this->scapeString(substr($inventarioElemento, 0, $this->INVENTARIO_ELEMENTO_SIZE));
            }else{
                $this->inventarioElemento = $this->scapeString($inventarioElemento);
            }
        }

        public function getInventarioNumeroSerie(){
            return $this->inventarioNumeroSerie;
        }

        public function setInventarioNumeroSerie($inventarioNumeroSerie){
            if(strlen($inventarioNumeroSerie) > $this->INVENTARIO_NUMERO_SERIE_SIZE){;
                $this->inventarioNumeroSerie = $this->scapeString(substr($inventarioNumeroSerie, 0, $this->INVENTARIO_NUMERO_SERIE_SIZE));
            }else{
                $this->inventarioNumeroSerie = $this->scapeString($inventarioNumeroSerie);
            }
        }

        public function getInventarioSalon(){
            return $this->inventarioSalon;
        }

        public function setInventarioSalon($inventarioSalon){
            $this->inventarioSalon = $inventarioSalon;
        }

        public function getComputadora(){
            return $this->computadora;
        }

        public function setComputadora($computadora){
            $this->computadora = $computadora;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->INVENTARIO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_SALON,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_SALON,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA);
        }

        public function getDbFieldNames(){
            return array($this->INVENTARIO_ELEMENTO,$this->INVENTARIO_NUMERO_SERIE,$this->INVENTARIO_SALON,$this->COMPUTADORA);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->INVENTARIO_ELEMENTO,$this->INVENTARIO_NUMERO_SERIE,$this->INVENTARIO_SALON,$this->COMPUTADORA);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->INVENTARIO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_SALON,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_NUMERO_SERIE,$this->ENTITY_DB_NAME.".".$this->INVENTARIO_SALON,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA);
        }

        public function getDbListFieldNames(){
            return array($this->INVENTARIO_ELEMENTO,$this->INVENTARIO_NUMERO_SERIE,$this->INVENTARIO_SALON,$this->COMPUTADORA);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->INVENTARIO_ELEMENTO,$this->INVENTARIO_NUMERO_SERIE,$this->INVENTARIO_SALON,$this->COMPUTADORA);
        }

        public function getDbFieldValues(){
            return array($this->getInventarioElemento(),$this->getInventarioNumeroSerie(),$this->getInventarioSalon(),$this->getComputadora());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getInventarioElemento(),$this->getInventarioNumeroSerie(),$this->getInventarioSalon(),$this->getComputadora());
        }

        public function getDbListFieldValues(){
            return array($this->getInventarioElemento(),$this->getInventarioNumeroSerie(),$this->getInventarioSalon(),$this->getComputadora());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getInventarioElemento(),$this->getInventarioNumeroSerie(),$this->getInventarioSalon(),$this->getComputadora());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->INVENTARIO_ELEMENTO]) && !ObjetoEnInventarioDTO::isEmpty($rq[$this->INVENTARIO_ELEMENTO])){
                $this->inventarioElemento = $this->scapeString($rq[$this->INVENTARIO_ELEMENTO]);
            }else{
                $this->inventarioElemento = null;
            }
            if(isset($rq[$this->INVENTARIO_NUMERO_SERIE]) && !ObjetoEnInventarioDTO::isEmpty($rq[$this->INVENTARIO_NUMERO_SERIE])){
                $this->inventarioNumeroSerie = $this->scapeString($rq[$this->INVENTARIO_NUMERO_SERIE]);
            }else{
                $this->inventarioNumeroSerie = null;
            }
            if(isset($rq[$this->INVENTARIO_SALON]) && !ObjetoEnInventarioDTO::isEmpty($rq[$this->INVENTARIO_SALON])){
                $this->inventarioSalon = $this->scapeString($rq[$this->INVENTARIO_SALON]);
            }else{
                $this->inventarioSalon = null;
            }
            if(isset($rq[$this->COMPUTADORA]) && !ObjetoEnInventarioDTO::isEmpty($rq[$this->COMPUTADORA])){
                $this->computadora = $this->scapeString($rq[$this->COMPUTADORA]);
            }else{
                $this->computadora = null;
            }
        }

        public function toDTO(){
            $objetoEnInventarioDTO = new ObjetoEnInventarioDTO();
            $objetoEnInventarioDTO->setId($this->getId());
            $objetoEnInventarioDTO->setInventarioElemento($this->unscapeString($this->getInventarioElemento()));
            $objetoEnInventarioDTO->setInventarioNumeroSerie($this->unscapeString($this->getInventarioNumeroSerie()));
            $objetoEnInventarioDTO->setInventarioSalon($this->unscapeString($this->getInventarioSalon()));
            $objetoEnInventarioDTO->setComputadora($this->unscapeString($this->getComputadora()));
            return $objetoEnInventarioDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->inventarioElemento) && EntityValidator::validateString($this->inventarioNumeroSerie) && EntityValidator::validateId($this->inventarioSalon) && EntityValidator::validateId($this->computadora);
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