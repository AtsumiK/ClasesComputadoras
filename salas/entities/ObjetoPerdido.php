<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.OBJETO_PERDIDO_DTO;

    class ObjetoPerdido {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "objeto_perdido";
        public $PRIMARY_KEY_DB_NAME = "objeto_perdido_id";

        public $OBJETO_PERDIDO_ELEMENTO = "objeto_perdido_elemento";
        public static $ORDER_BY_OBJETO_PERDIDO_ELEMENTO = "objeto_perdido_elemento";
        public $OBJETO_PERDIDO_FECHA = "objeto_perdido_fecha";
        public static $ORDER_BY_OBJETO_PERDIDO_FECHA = "objeto_perdido_fecha";
        public $OBJETO_PERDIDO_CORREO = "objeto_perdido_correo";
        public static $ORDER_BY_OBJETO_PERDIDO_CORREO = "objeto_perdido_correo";
        public $OBJETO_PERDIDO_FECHA_DEVOLUCION = "objeto_perdido_fecha_devolucion";
        public static $ORDER_BY_OBJETO_PERDIDO_FECHA_DEVOLUCION = "objeto_perdido_fecha_devolucion";
        public $OBJETO_PERDIDO_COMENTARIOS = "objeto_perdido_comentarios";
        public static $ORDER_BY_OBJETO_PERDIDO_COMENTARIOS = "objeto_perdido_comentarios";
        public $OBJETO_PERDIDO_SALON = "objeto_perdido_salon";
        public static $ORDER_BY_OBJETO_PERDIDO_SALON = "objeto_perdido_salon";
        public $OBJETO_PERDIDO_ESTUDIANTE = "objeto_perdido_estudiante";
        public static $ORDER_BY_OBJETO_PERDIDO_ESTUDIANTE = "objeto_perdido_estudiante";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $OBJETO_PERDIDO_ELEMENTO_SIZE = 250;
        private $OBJETO_PERDIDO_CORREO_SIZE = 250;
        private $OBJETO_PERDIDO_COMENTARIOS_SIZE = 5000;

        # Atributos privados estandar
        private $id;
        private $objetoPerdidoElemento;
        private $objetoPerdidoFecha;
        private $objetoPerdidoCorreo;
        private $objetoPerdidoFechaDevolucion;
        private $objetoPerdidoComentarios;
        private $objetoPerdidoSalon;
        private $objetoPerdidoEstudiante;

        function ObjetoPerdido($objetoPerdidoElemento = null, $objetoPerdidoFecha = null, $objetoPerdidoCorreo = null, $objetoPerdidoFechaDevolucion = null, $objetoPerdidoComentarios = null, $objetoPerdidoSalon = null, $objetoPerdidoEstudiante = null){
            $this->id = null;
            $this->objetoPerdidoElemento = $this->scapeString($objetoPerdidoElemento);
            $this->objetoPerdidoFecha = $this->scapeString($objetoPerdidoFecha);
            $this->objetoPerdidoCorreo = $this->scapeString($objetoPerdidoCorreo);
            $this->objetoPerdidoFechaDevolucion = $this->scapeString($objetoPerdidoFechaDevolucion);
            $this->objetoPerdidoComentarios = $this->scapeString($objetoPerdidoComentarios);
            $this->objetoPerdidoSalon = $this->scapeString($objetoPerdidoSalon);
            $this->objetoPerdidoEstudiante = $this->scapeString($objetoPerdidoEstudiante);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getObjetoPerdidoElemento(){
            return $this->objetoPerdidoElemento;
        }

        public function setObjetoPerdidoElemento($objetoPerdidoElemento){
            if(strlen($objetoPerdidoElemento) > $this->OBJETO_PERDIDO_ELEMENTO_SIZE){;
                $this->objetoPerdidoElemento = $this->scapeString(substr($objetoPerdidoElemento, 0, $this->OBJETO_PERDIDO_ELEMENTO_SIZE));
            }else{
                $this->objetoPerdidoElemento = $this->scapeString($objetoPerdidoElemento);
            }
        }

        public function getObjetoPerdidoFecha(){
            return $this->objetoPerdidoFecha;
        }

        public function setObjetoPerdidoFecha($objetoPerdidoFecha){
            $this->objetoPerdidoFecha = $objetoPerdidoFecha;
        }

        public function getObjetoPerdidoCorreo(){
            return $this->objetoPerdidoCorreo;
        }

        public function setObjetoPerdidoCorreo($objetoPerdidoCorreo){
            if(strlen($objetoPerdidoCorreo) > $this->OBJETO_PERDIDO_CORREO_SIZE){;
                $this->objetoPerdidoCorreo = $this->scapeString(substr($objetoPerdidoCorreo, 0, $this->OBJETO_PERDIDO_CORREO_SIZE));
            }else{
                $this->objetoPerdidoCorreo = $this->scapeString($objetoPerdidoCorreo);
            }
        }

        public function getObjetoPerdidoFechaDevolucion(){
            return $this->objetoPerdidoFechaDevolucion;
        }

        public function setObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion){
            $this->objetoPerdidoFechaDevolucion = $objetoPerdidoFechaDevolucion;
        }

        public function getObjetoPerdidoComentarios(){
            return $this->objetoPerdidoComentarios;
        }

        public function setObjetoPerdidoComentarios($objetoPerdidoComentarios){
            if(strlen($objetoPerdidoComentarios) > $this->OBJETO_PERDIDO_COMENTARIOS_SIZE){;
                $this->objetoPerdidoComentarios = $this->scapeString(substr($objetoPerdidoComentarios, 0, $this->OBJETO_PERDIDO_COMENTARIOS_SIZE));
            }else{
                $this->objetoPerdidoComentarios = $this->scapeString($objetoPerdidoComentarios);
            }
        }

        public function getObjetoPerdidoSalon(){
            return $this->objetoPerdidoSalon;
        }

        public function setObjetoPerdidoSalon($objetoPerdidoSalon){
            $this->objetoPerdidoSalon = $objetoPerdidoSalon;
        }

        public function getObjetoPerdidoEstudiante(){
            return $this->objetoPerdidoEstudiante;
        }

        public function setObjetoPerdidoEstudiante($objetoPerdidoEstudiante){
            $this->objetoPerdidoEstudiante = $objetoPerdidoEstudiante;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_CORREO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_SALON,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_CORREO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_SALON,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getDbFieldNames(){
            return array($this->OBJETO_PERDIDO_ELEMENTO,$this->OBJETO_PERDIDO_FECHA,$this->OBJETO_PERDIDO_CORREO,$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->OBJETO_PERDIDO_COMENTARIOS,$this->OBJETO_PERDIDO_SALON,$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->OBJETO_PERDIDO_ELEMENTO,$this->OBJETO_PERDIDO_FECHA,$this->OBJETO_PERDIDO_CORREO,$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->OBJETO_PERDIDO_COMENTARIOS,$this->OBJETO_PERDIDO_SALON,$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_CORREO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_SALON,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ELEMENTO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_CORREO,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_COMENTARIOS,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_SALON,$this->ENTITY_DB_NAME.".".$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getDbListFieldNames(){
            return array($this->OBJETO_PERDIDO_ELEMENTO,$this->OBJETO_PERDIDO_FECHA,$this->OBJETO_PERDIDO_CORREO,$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->OBJETO_PERDIDO_COMENTARIOS,$this->OBJETO_PERDIDO_SALON,$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->OBJETO_PERDIDO_ELEMENTO,$this->OBJETO_PERDIDO_FECHA,$this->OBJETO_PERDIDO_CORREO,$this->OBJETO_PERDIDO_FECHA_DEVOLUCION,$this->OBJETO_PERDIDO_COMENTARIOS,$this->OBJETO_PERDIDO_SALON,$this->OBJETO_PERDIDO_ESTUDIANTE);
        }

        public function getDbFieldValues(){
            return array($this->getObjetoPerdidoElemento(),$this->getObjetoPerdidoFecha(),$this->getObjetoPerdidoCorreo(),$this->getObjetoPerdidoFechaDevolucion(),$this->getObjetoPerdidoComentarios(),$this->getObjetoPerdidoSalon(),$this->getObjetoPerdidoEstudiante());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getObjetoPerdidoElemento(),$this->getObjetoPerdidoFecha(),$this->getObjetoPerdidoCorreo(),$this->getObjetoPerdidoFechaDevolucion(),$this->getObjetoPerdidoComentarios(),$this->getObjetoPerdidoSalon(),$this->getObjetoPerdidoEstudiante());
        }

        public function getDbListFieldValues(){
            return array($this->getObjetoPerdidoElemento(),$this->getObjetoPerdidoFecha(),$this->getObjetoPerdidoCorreo(),$this->getObjetoPerdidoFechaDevolucion(),$this->getObjetoPerdidoComentarios(),$this->getObjetoPerdidoSalon(),$this->getObjetoPerdidoEstudiante());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getObjetoPerdidoElemento(),$this->getObjetoPerdidoFecha(),$this->getObjetoPerdidoCorreo(),$this->getObjetoPerdidoFechaDevolucion(),$this->getObjetoPerdidoComentarios(),$this->getObjetoPerdidoSalon(),$this->getObjetoPerdidoEstudiante());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->OBJETO_PERDIDO_ELEMENTO]) && !ObjetoPerdidoDTO::isEmpty($rq[$this->OBJETO_PERDIDO_ELEMENTO])){
                $this->objetoPerdidoElemento = $this->scapeString($rq[$this->OBJETO_PERDIDO_ELEMENTO]);
            }else{
                $this->objetoPerdidoElemento = null;
            }
            if(isset($rq[$this->OBJETO_PERDIDO_FECHA]) && !ObjetoPerdidoDTO::isEmpty($rq[$this->OBJETO_PERDIDO_FECHA])){
                $this->objetoPerdidoFecha = $this->scapeString($rq[$this->OBJETO_PERDIDO_FECHA]);
            }else{
                $this->objetoPerdidoFecha = null;
            }
            if(isset($rq[$this->OBJETO_PERDIDO_CORREO]) && !ObjetoPerdidoDTO::isEmpty($rq[$this->OBJETO_PERDIDO_CORREO])){
                $this->objetoPerdidoCorreo = $this->scapeString($rq[$this->OBJETO_PERDIDO_CORREO]);
            }else{
                $this->objetoPerdidoCorreo = null;
            }
            if(isset($rq[$this->OBJETO_PERDIDO_FECHA_DEVOLUCION]) && !ObjetoPerdidoDTO::isEmpty($rq[$this->OBJETO_PERDIDO_FECHA_DEVOLUCION])){
                $this->objetoPerdidoFechaDevolucion = $this->scapeString($rq[$this->OBJETO_PERDIDO_FECHA_DEVOLUCION]);
            }else{
                $this->objetoPerdidoFechaDevolucion = null;
            }
            if(isset($rq[$this->OBJETO_PERDIDO_COMENTARIOS]) && !ObjetoPerdidoDTO::isEmpty($rq[$this->OBJETO_PERDIDO_COMENTARIOS])){
                $this->objetoPerdidoComentarios = $this->scapeString($rq[$this->OBJETO_PERDIDO_COMENTARIOS]);
            }else{
                $this->objetoPerdidoComentarios = null;
            }
            if(isset($rq[$this->OBJETO_PERDIDO_SALON]) && !ObjetoPerdidoDTO::isEmpty($rq[$this->OBJETO_PERDIDO_SALON])){
                $this->objetoPerdidoSalon = $this->scapeString($rq[$this->OBJETO_PERDIDO_SALON]);
            }else{
                $this->objetoPerdidoSalon = null;
            }
            if(isset($rq[$this->OBJETO_PERDIDO_ESTUDIANTE]) && !ObjetoPerdidoDTO::isEmpty($rq[$this->OBJETO_PERDIDO_ESTUDIANTE])){
                $this->objetoPerdidoEstudiante = $this->scapeString($rq[$this->OBJETO_PERDIDO_ESTUDIANTE]);
            }else{
                $this->objetoPerdidoEstudiante = null;
            }
        }

        public function toDTO(){
            $objetoPerdidoDTO = new ObjetoPerdidoDTO();
            $objetoPerdidoDTO->setId($this->getId());
            $objetoPerdidoDTO->setObjetoPerdidoElemento($this->unscapeString($this->getObjetoPerdidoElemento()));
            $objetoPerdidoDTO->setObjetoPerdidoFecha($this->unscapeString($this->getObjetoPerdidoFecha()));
            $objetoPerdidoDTO->setObjetoPerdidoCorreo($this->unscapeString($this->getObjetoPerdidoCorreo()));
            $objetoPerdidoDTO->setObjetoPerdidoFechaDevolucion($this->unscapeString($this->getObjetoPerdidoFechaDevolucion()));
            $objetoPerdidoDTO->setObjetoPerdidoComentarios($this->unscapeString($this->getObjetoPerdidoComentarios()));
            $objetoPerdidoDTO->setObjetoPerdidoSalon($this->unscapeString($this->getObjetoPerdidoSalon()));
            $objetoPerdidoDTO->setObjetoPerdidoEstudiante($this->unscapeString($this->getObjetoPerdidoEstudiante()));
            return $objetoPerdidoDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            if($this->objetoPerdidoEstudiante !== null){
                $otherValidations = $otherValidations &&  EntityValidator::validateId($this->objetoPerdidoEstudiante);
            }
            return $otherValidations && EntityValidator::validateString($this->objetoPerdidoElemento) && EntityValidator::validateString($this->objetoPerdidoFecha) && EntityValidator::validateString($this->objetoPerdidoCorreo) && EntityValidator::validateString($this->objetoPerdidoFechaDevolucion) && EntityValidator::validateId($this->objetoPerdidoSalon);
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