<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.PRESTAMO_DTO;

    class Prestamo {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "prestamo";
        public $PRIMARY_KEY_DB_NAME = "prestamo_id";

        public $PRESTAMO_ENTRADA = "prestamo_entrada";
        public static $ORDER_BY_PRESTAMO_ENTRADA = "prestamo_entrada";
        public $PRESTAMO_SALIDA = "prestamo_salida";
        public static $ORDER_BY_PRESTAMO_SALIDA = "prestamo_salida";
        public $PRESTAMO_COMENTARIOS = "prestamo_comentarios";
        public static $ORDER_BY_PRESTAMO_COMENTARIOS = "prestamo_comentarios";
        public $PRESTAMO_ESTUDIANTE = "prestamo_estudiante";
        public static $ORDER_BY_PRESTAMO_ESTUDIANTE = "prestamo_estudiante";
        public $PRESTAMO_COMPUTADORA = "prestamo_computadora";
        public static $ORDER_BY_PRESTAMO_COMPUTADORA = "prestamo_computadora";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $PRESTAMO_COMENTARIOS_SIZE = 5000;

        # Atributos privados estandar
        private $id;
        private $prestamoEntrada;
        private $prestamoSalida;
        private $prestamoComentarios;
        private $prestamoEstudiante;
        private $prestamoComputadora;

        function Prestamo($prestamoEntrada = null, $prestamoSalida = null, $prestamoComentarios = null, $prestamoEstudiante = null, $prestamoComputadora = null){
            $this->id = null;
            $this->prestamoEntrada = $this->scapeString($prestamoEntrada);
            $this->prestamoSalida = $this->scapeString($prestamoSalida);
            $this->prestamoComentarios = $this->scapeString($prestamoComentarios);
            $this->prestamoEstudiante = $this->scapeString($prestamoEstudiante);
            $this->prestamoComputadora = $this->scapeString($prestamoComputadora);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getPrestamoEntrada(){
            return $this->prestamoEntrada;
        }

        public function setPrestamoEntrada($prestamoEntrada){
            $this->prestamoEntrada = $prestamoEntrada;
        }

        public function getPrestamoSalida(){
            return $this->prestamoSalida;
        }

        public function setPrestamoSalida($prestamoSalida){
            $this->prestamoSalida = $prestamoSalida;
        }

        public function getPrestamoComentarios(){
            return $this->prestamoComentarios;
        }

        public function setPrestamoComentarios($prestamoComentarios){
            if(strlen($prestamoComentarios) > $this->PRESTAMO_COMENTARIOS_SIZE){;
                $this->prestamoComentarios = $this->scapeString(substr($prestamoComentarios, 0, $this->PRESTAMO_COMENTARIOS_SIZE));
            }else{
                $this->prestamoComentarios = $this->scapeString($prestamoComentarios);
            }
        }

        public function getPrestamoEstudiante(){
            return $this->prestamoEstudiante;
        }

        public function setPrestamoEstudiante($prestamoEstudiante){
            $this->prestamoEstudiante = $prestamoEstudiante;
        }

        public function getPrestamoComputadora(){
            return $this->prestamoComputadora;
        }

        public function setPrestamoComputadora($prestamoComputadora){
            $this->prestamoComputadora = $prestamoComputadora;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA);
        }

        public function getDbFieldNames(){
            return array($this->PRESTAMO_ENTRADA,$this->PRESTAMO_SALIDA,$this->PRESTAMO_COMENTARIOS,$this->PRESTAMO_ESTUDIANTE,$this->PRESTAMO_COMPUTADORA);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->PRESTAMO_ENTRADA,$this->PRESTAMO_SALIDA,$this->PRESTAMO_COMENTARIOS,$this->PRESTAMO_ESTUDIANTE,$this->PRESTAMO_COMPUTADORA);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA);
        }

        public function getDbListFieldNames(){
            return array($this->PRESTAMO_ENTRADA,$this->PRESTAMO_SALIDA,$this->PRESTAMO_COMENTARIOS,$this->PRESTAMO_ESTUDIANTE,$this->PRESTAMO_COMPUTADORA);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->PRESTAMO_ENTRADA,$this->PRESTAMO_SALIDA,$this->PRESTAMO_COMENTARIOS,$this->PRESTAMO_ESTUDIANTE,$this->PRESTAMO_COMPUTADORA);
        }

        public function getDbFieldValues(){
            return array($this->getPrestamoEntrada(),$this->getPrestamoSalida(),$this->getPrestamoComentarios(),$this->getPrestamoEstudiante(),$this->getPrestamoComputadora());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getPrestamoEntrada(),$this->getPrestamoSalida(),$this->getPrestamoComentarios(),$this->getPrestamoEstudiante(),$this->getPrestamoComputadora());
        }

        public function getDbListFieldValues(){
            return array($this->getPrestamoEntrada(),$this->getPrestamoSalida(),$this->getPrestamoComentarios(),$this->getPrestamoEstudiante(),$this->getPrestamoComputadora());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getPrestamoEntrada(),$this->getPrestamoSalida(),$this->getPrestamoComentarios(),$this->getPrestamoEstudiante(),$this->getPrestamoComputadora());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->PRESTAMO_ENTRADA]) && !PrestamoDTO::isEmpty($rq[$this->PRESTAMO_ENTRADA])){
                $this->prestamoEntrada = $this->scapeString($rq[$this->PRESTAMO_ENTRADA]);
            }else{
                $this->prestamoEntrada = null;
            }
            if(isset($rq[$this->PRESTAMO_SALIDA]) && !PrestamoDTO::isEmpty($rq[$this->PRESTAMO_SALIDA])){
                $this->prestamoSalida = $this->scapeString($rq[$this->PRESTAMO_SALIDA]);
            }else{
                $this->prestamoSalida = null;
            }
            if(isset($rq[$this->PRESTAMO_COMENTARIOS]) && !PrestamoDTO::isEmpty($rq[$this->PRESTAMO_COMENTARIOS])){
                $this->prestamoComentarios = $this->scapeString($rq[$this->PRESTAMO_COMENTARIOS]);
            }else{
                $this->prestamoComentarios = null;
            }
            if(isset($rq[$this->PRESTAMO_ESTUDIANTE]) && !PrestamoDTO::isEmpty($rq[$this->PRESTAMO_ESTUDIANTE])){
                $this->prestamoEstudiante = $this->scapeString($rq[$this->PRESTAMO_ESTUDIANTE]);
            }else{
                $this->prestamoEstudiante = null;
            }
            if(isset($rq[$this->PRESTAMO_COMPUTADORA]) && !PrestamoDTO::isEmpty($rq[$this->PRESTAMO_COMPUTADORA])){
                $this->prestamoComputadora = $this->scapeString($rq[$this->PRESTAMO_COMPUTADORA]);
            }else{
                $this->prestamoComputadora = null;
            }
        }

        public function toDTO(){
            $prestamoDTO = new PrestamoDTO();
            $prestamoDTO->setId($this->getId());
            $prestamoDTO->setPrestamoEntrada($this->unscapeString($this->getPrestamoEntrada()));
            $prestamoDTO->setPrestamoSalida($this->unscapeString($this->getPrestamoSalida()));
            $prestamoDTO->setPrestamoComentarios($this->unscapeString($this->getPrestamoComentarios()));
            $prestamoDTO->setPrestamoEstudiante($this->unscapeString($this->getPrestamoEstudiante()));
            $prestamoDTO->setPrestamoComputadora($this->unscapeString($this->getPrestamoComputadora()));
            return $prestamoDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->prestamoEntrada) && EntityValidator::validateString($this->prestamoSalida) && EntityValidator::validateId($this->prestamoEstudiante) && EntityValidator::validateId($this->prestamoComputadora);
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